<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\Department;
use App\Models\ReportStatus;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalReports = Report::count();

        $totalUsers = User::count();

        $totalDepartments = Department::count();

        $totalOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'department_officer');
        })->count();

        $pendingReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'submitted');
        })->count();

        $resolvedReports = Report::whereHas('status', function ($query) {
            $query->where('slug', 'resolved');
        })->count();

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
            'resolvedReports',
            'recentReports'
        ));
    }
}