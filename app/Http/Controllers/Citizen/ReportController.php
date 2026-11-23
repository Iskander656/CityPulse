<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportImage;
use App\Models\ReportStatus;
use App\Services\CityPulseAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function index(): View
    {
        $reports = Report::where('user_id', auth()->id())
            ->with(['category', 'status'])
            ->latest()
            ->paginate(10);

        return view('citizen.reports.index', compact('reports'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('citizen.reports.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id,is_active,1',
            ],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:255'],

            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        // Ask the AI service for a category recommendation.
        // The citizen's selected category remains the final category for now.
        $aiSuggestion = null;

        try {
            $aiSuggestion = app(CityPulseAIService::class)
                ->classifyReport($validated['description']);
        } catch (\Throwable $exception) {
            // AI availability must not prevent a citizen from submitting a report.
            report($exception);
        }

        $status = ReportStatus::where('slug', 'submitted')->firstOrFail();

        $departmentByCategory = [
            'Road Damage' => 'Road Maintenance',
            'Street Lighting' => 'Public Lighting',
            'Traffic Signals' => 'Traffic Management',
            'Road Obstructions' => 'Road Maintenance',
            'Waste Management' => 'Waste Management',
            'Public Infrastructure' => 'Public Infrastructure',
        ];

        $category = Category::findOrFail($validated['category_id']);
        $departmentName = $departmentByCategory[$category->name] ?? null;

        abort_if(
            $departmentName === null,
            422,
            'No department is configured for this report category.'
        );

        $department = Department::where('name', $departmentName)
            ->where('is_active', true)
            ->firstOrFail();

        $storedFiles = [];

        // Prepare officers belonging to the responsible department.// Prepare officers belonging to the responsible department.
        $officers = User::whereHas('role', function ($query) {
            $query->where('name', 'department_officer');
        })
            ->where('department_id', $department->id)
            ->get()
            ->map(function ($officer) use ($department) {

                $activeComplaints = Report::where(
                    'assigned_officer_id',
                    $officer->id
                )
                    ->whereHas('status', function ($query) {
                        $query->whereNotIn('slug', [
                            'resolved',
                            'closed',
                            'completed',
                            'cancelled',
                        ]);
                    })
                    ->count();

                return [
                    'id' => $officer->id,
                    'name' => $officer->name,
                    'department' => $department->name,
                    'is_active' => true,
                    'is_available' => true,
                    'active_complaints' => $activeComplaints,
                    'max_capacity' => 10,
                ];
            })
            ->values()
            ->all();

        $assignmentResult = null;
        $assignedOfficerId = null;

        try {
            $response = Http::timeout(10)->post(
                rtrim(env('AI_SERVICE_URL', 'http://127.0.0.1:8000'), '/')
                    . '/assign-officer',
                [
                    'complaint_category' => $department->name,
                    'officers' => $officers,
                ]
            );

            if ($response->successful() && $response->json('success')) {
                $assignmentResult = $response->json();
                $assignedOfficerId = data_get(
                    $assignmentResult,
                    'officer.id'
                );
            }
        } catch (\Throwable $exception) {
            report($exception);
        }

        try {
            DB::transaction(function () use (
                $assignedOfficerId,
                $assignmentResult,
                $validated,
                $request,
                $status,
                $department,
                $aiSuggestion,
                &$storedFiles
            ) {
                $report = Report::create([
                    'user_id' => auth()->id(),
                    'category_id' => $validated['category_id'],
                    'status_id' => $status->id,
                    'assigned_department_id' => $department->id,
                    'assigned_officer_id' => $assignedOfficerId,
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'latitude' => $validated['latitude'],
                    'longitude' => $validated['longitude'],
                    'address' => $validated['address'] ?? null,
                    'ai_suggested_category' => $aiSuggestion['category'] ?? null,
                    'ai_confidence' => $aiSuggestion['confidence'] ?? null,
                ]);

                foreach ($request->file('images', []) as $image) {
                    $path = $image->store('reports', 'public');

                    $storedFiles[] = $path;

                    ReportImage::create([
                        'report_id' => $report->id,
                        'image_path' => $path,
                        'original_name' => $image->getClientOriginalName(),
                        'mime_type' => $image->getMimeType(),
                        'file_size' => $image->getSize(),
                    ]);
                }

                ReportActivity::create([
                    'report_id' => $report->id,
                    'user_id' => auth()->id(),
                    'new_status_id' => $status->id,
                    'activity_type' => 'submitted',
                    'description' => 'Report submitted by citizen.' . (
                        $assignmentResult
                        ? ' AI assignment: ' . data_get($assignmentResult, 'reason')
                        . ' Workload: ' . data_get($assignmentResult, 'assignment_details.active_complaints')
                        . '/' . data_get($assignmentResult, 'assignment_details.capacity')
                        . ' (' . data_get($assignmentResult, 'assignment_details.workload_percentage') . '%).'
                        : ''
                    ),
                ]);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($storedFiles);

            throw $exception;
        }

        $redirect = redirect()
            ->route('citizen.reports.index')
            ->with('success', 'Your report has been submitted successfully.');

        if ($aiSuggestion !== null) {
            $redirect->with('ai_suggestion', $aiSuggestion);
        }

        return $redirect;
    }

    public function show(Report $report): View
    {
        abort_unless((int) $report->user_id === (int) auth()->id(), 404);

        $report->load([
            'category',
            'status',
            'images',
            'activities.user',
            'activities.oldStatus',
            'activities.newStatus',
        ]);

        return view('citizen.reports.show', compact('report'));
    }
}