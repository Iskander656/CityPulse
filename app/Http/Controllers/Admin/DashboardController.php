<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // General statistics
        $totalReports = Report::count();
        $totalUsers = User::count();
        $totalDepartments = Department::count();

        $totalOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'department_officer');
        })->count();

        // Report status statistics
        $pendingReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'submitted');
        })->count();

        $underReviewReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'under-review');
        })->count();

        $inProgressReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'in-progress');
        })->count();

        $resolvedReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'resolved');
        })->count();

        $rejectedReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'rejected');
        })->count();

        // Resolution rate
        $resolutionRate = $totalReports > 0
            ? round(($resolvedReports / $totalReports) * 100, 1)
            : 0;

        // Department performance
        $departmentPerformance = Department::query()
            ->leftJoin('reports', 'departments.id', '=', 'reports.assigned_department_id')
            ->leftJoin('report_statuses', 'reports.status_id', '=', 'report_statuses.id')
            ->select('departments.id', 'departments.name')
            ->selectRaw('COUNT(reports.id) as total_reports')
            ->selectRaw("SUM(CASE WHEN report_statuses.slug = 'in-progress' THEN 1 ELSE 0 END) as in_progress_reports")
            ->selectRaw("SUM(CASE WHEN report_statuses.slug = 'resolved' THEN 1 ELSE 0 END) as resolved_reports")
            ->groupBy('departments.id', 'departments.name')
            ->orderBy('departments.name')
            ->get();

        // Most frequently reported categories
        $categoryInsights = DB::table('categories')
            ->leftJoin('reports', 'categories.id', '=', 'reports.category_id')
            ->select('categories.id', 'categories.name')
            ->selectRaw('COUNT(reports.id) as total_reports')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_reports')
            ->take(5)
            ->get();

        // Monthly reporting trends (last 6 months)
        $monthlyReportTrends = [];

        $startMonth = now()->subMonths(5)->startOfMonth();

        $monthlyReports = Report::query()
            ->where('created_at', '>=', $startMonth)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ->selectRaw('COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        for ($i = 0; $i < 6; $i++) {
            $month = $startMonth->copy()->addMonths($i);

            $monthlyReportTrends[] = [
                'month' => $month->format('M Y'),
                'total' => (int) ($monthlyReports[$month->format('Y-m')] ?? 0),
            ];
        }

        // Recent reports
        $recentReports = Report::with([
            'user',
            'category',
            'status',
            'department',
        ])->latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalReports',
            'totalUsers',
            'totalDepartments',
            'totalOfficers',
            'pendingReports',
            'underReviewReports',
            'inProgressReports',
            'resolvedReports',
            'rejectedReports',
            'resolutionRate',
            'departmentPerformance',
            'categoryInsights',
            'monthlyReportTrends',
            'recentReports'
        ));
    }

    public function map(): View
    {
        $reports = Report::with(['category', 'status'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereHas('status', function ($query) {
                $query->where('slug', '!=', 'resolved');
            })
            ->orderByRaw("CASE
                WHEN (SELECT slug FROM report_statuses WHERE report_statuses.id = reports.status_id) = 'submitted' THEN 1
                WHEN (SELECT slug FROM report_statuses WHERE report_statuses.id = reports.status_id) = 'under-review' THEN 2
                WHEN (SELECT slug FROM report_statuses WHERE report_statuses.id = reports.status_id) = 'in-progress' THEN 3
                WHEN (SELECT slug FROM report_statuses WHERE report_statuses.id = reports.status_id) = 'rejected' THEN 4
                ELSE 5
            END")
            ->latest('created_at')
            ->get();

        return view('admin.map', compact('reports'));
    }
}