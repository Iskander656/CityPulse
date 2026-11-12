<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportImage;
use App\Models\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
            'category_id' => ['required', 'exists:categories,id'],
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

        $status = ReportStatus::where('slug', 'submitted')->firstOrFail();

        $storedFiles = [];

        try {
            DB::transaction(function () use (
                $validated,
                $request,
                $status,
                &$storedFiles
            ) {
                $report = Report::create([
                    'user_id' => auth()->id(),
                    'category_id' => $validated['category_id'],
                    'status_id' => $status->id,
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'latitude' => $validated['latitude'],
                    'longitude' => $validated['longitude'],
                    'address' => $validated['address'] ?? null,
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
                    'description' => 'Report submitted by citizen.',
                ]);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($storedFiles);

            throw $exception;
        }

        return redirect()
            ->route('citizen.reports.index')
            ->with('success', 'Your report has been submitted successfully.');
    }

    public function show(Report $report): View
    {
        abort_unless($report->user_id === auth()->id(), 404);

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