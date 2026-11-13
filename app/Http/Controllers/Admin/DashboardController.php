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
            'recentReports'
        ));
    }
}