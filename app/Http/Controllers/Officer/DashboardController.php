<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportStatus;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $departmentId = auth()->user()->department_id;

        $reports = Report::where('assigned_department_id', $departmentId);

        $totalReports = (clone $reports)->count();

        $submittedStatusId = ReportStatus::where('slug', 'submitted')->value('id');

        $inProgressStatusId = ReportStatus::where('slug', 'in-progress')->value('id');

        $resolvedStatusId = ReportStatus::where('slug', 'resolved')->value('id');

        $pendingReports = (clone $reports)
            ->where('status_id', $submittedStatusId)
            ->count();

        $inProgressReports = (clone $reports)
            ->where('status_id', $inProgressStatusId)
            ->count();

        $resolvedReports = (clone $reports)
            ->where('status_id', $resolvedStatusId)
            ->count();

        $recentReports = (clone $reports)
            ->with(['category', 'status', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('officer.dashboard', compact(
            'totalReports',
            'pendingReports',
            'inProgressReports',
            'resolvedReports',
            'recentReports'
        ));
    }
}