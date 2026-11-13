<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    private function departmentReports()
    {
        $departmentId = auth()->user()->department_id;

        abort_if(!$departmentId, 403, 'No department assigned.');

        return Report::where('assigned_department_id', $departmentId);
    }

    public function index(): View
    {
        $reports = $this->departmentReports()
            ->with(['category', 'status', 'user'])
            ->latest()
            ->paginate(15);

        return view('officer.reports.index', compact('reports'));
    }

    public function show(Report $report): View
    {
        $report = $this->departmentReports()
            ->whereKey($report->id)
            ->with([
                'category',
                'status',
                'user',
                'images',
                'activities.user',
                'activities.oldStatus',
                'activities.newStatus',
            ])
            ->firstOrFail();

        $statuses = ReportStatus::orderBy('sort_order')->get();

        return view('officer.reports.show', compact(
            'report',
            'statuses'
        ));
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        $report = $this->departmentReports()
            ->whereKey($report->id)
            ->with('status')
            ->firstOrFail();

        abort_if($report->status->is_final, 403, 'This report is already closed.');

        $validated = $request->validate([
            'status_id' => ['required', 'exists:report_statuses,id'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $newStatus = ReportStatus::findOrFail($validated['status_id']);

        DB::transaction(function () use ($report, $newStatus, $validated) {

            $oldStatus = $report->status;

            if ($oldStatus->id === $newStatus->id && empty($validated['notes'])) {
                return;
            }

            $report->update([
                'status_id' => $newStatus->id,
            ]);

            $activityType = match ($newStatus->slug) {
                'resolved' => 'resolved',
                'rejected' => 'rejected',
                default => $oldStatus->id === $newStatus->id
                    ? 'info_added'
                    : 'status_changed',
            };

            $description = $validated['notes']
                ?? "Status changed from {$oldStatus->name} to {$newStatus->name}.";

            ReportActivity::create([
                'report_id' => $report->id,
                'user_id' => auth()->id(),
                'old_status_id' => $oldStatus->id,
                'new_status_id' => $newStatus->id,
                'activity_type' => $activityType,
                'description' => $description,
            ]);
        });

        return redirect()
            ->route('officer.reports.show', $report)
            ->with('success', 'Report updated successfully.');
    }
}