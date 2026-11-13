<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportAssignment;
use App\Models\Category;
use App\Models\ReportStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $reports = Report::with([
            'user',
            'category',
            'status',
            'department',
            'assignedOfficer',
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when(
                $request->status_id,
                fn($query, $id) =>
                $query->where('status_id', $id)
            )
            ->when(
                $request->category_id,
                fn($query, $id) =>
                $query->where('category_id', $id)
            )
            ->when(
                $request->department_id,
                fn($query, $id) =>
                $query->where('assigned_department_id', $id)
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statuses = ReportStatus::orderBy('sort_order')->get();
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('admin.reports.index', compact(
            'reports',
            'statuses',
            'categories',
            'departments'
        ));
    }

    public function show(Report $report): View
    {
        $report->load([
            'user',
            'category',
            'status',
            'department',
            'assignedOfficer',
            'images',
            'activities.user',
            'activities.oldStatus',
            'activities.newStatus',
        ]);

        $departments = Department::orderBy('name')->get();

        $officers = User::whereHas('role', function ($query) {
            $query->where('name', 'department_officer');
        })
            ->with('department')
            ->orderBy('name')
            ->get();

        return view('admin.reports.show', compact(
            'report',
            'departments',
            'officers'
        ));
    }

    public function updateAssignment(
        Request $request,
        Report $report
    ): RedirectResponse {

        $validated = $request->validate([
            'department_id' => [
                'required',
                'exists:departments,id',
            ],
            'officer_id' => [
                'nullable',
                'exists:users,id',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $department = Department::findOrFail(
            $validated['department_id']
        );

        if (!$department->is_active) {
            return back()
                ->withErrors([
                    'department_id' => 'This department is inactive.',
                ])
                ->withInput();
        }

        $officer = null;

        if (!empty($validated['officer_id'])) {
            $officer = User::with('role')->findOrFail(
                $validated['officer_id']
            );

            if (
                $officer->role?->name !== 'department_officer' ||
                $officer->department_id !== $department->id
            ) {
                return back()
                    ->withErrors([
                        'officer_id' => 'The selected officer does not belong to this department.',
                    ])
                    ->withInput();
            }
        }

        DB::transaction(function () use (
            $report,
            $department,
            $officer,
            $validated
        ) {
            $oldDepartment = $report->department;
            $oldOfficer = $report->assignedOfficer;

            $departmentChanged =
                $report->assigned_department_id !== $department->id;

            $officerChanged =
                $report->assigned_officer_id !== $officer?->id;

            if (!$departmentChanged && !$officerChanged) {
                return;
            }

            $report->update([
                'assigned_department_id' => $department->id,
                'assigned_officer_id' => $officer?->id,
            ]);

            ReportAssignment::create([
                'report_id' => $report->id,
                'department_id' => $department->id,
                'officer_id' => $officer?->id,
                'assigned_by' => auth()->id(),
                'notes' => $validated['notes'] ?? null,
            ]);

            if ($departmentChanged) {
                ReportActivity::create([
                    'report_id' => $report->id,
                    'user_id' => auth()->id(),
                    'activity_type' => 'department_assigned',
                    'description' => 'Department assignment changed from '
                        . ($oldDepartment?->name ?? 'Unassigned')
                        . ' to ' . $department->name . '.',
                ]);
            }

            if ($officerChanged && $officer) {
                ReportActivity::create([
                    'report_id' => $report->id,
                    'user_id' => auth()->id(),
                    'activity_type' => 'officer_assigned',
                    'description' => 'Report assigned to officer '
                        . $officer->name . '.',
                ]);
            }
        });

        return redirect()
            ->route('admin.reports.show', $report)
            ->with('success', 'Report assignment updated successfully.');
    }
}