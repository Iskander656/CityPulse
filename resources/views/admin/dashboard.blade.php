@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <div class="container-fluid py-4 text-light">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">
            <div>
                <span class="text-danger fw-bold small text-uppercase">
                    CityPulse Administration
                </span>

                <h1 class="fw-bold mt-2 mb-1">
                    Command Centre
                </h1>

                <p class="text-secondary mb-0">
                    Welcome back, {{ auth()->user()->name }}.
                    Here's what's happening across your city.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-danger px-3 py-2">
                    Administrator
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger">
                        Logout
                    </button>
                </form>
            </div>
        </div>


        {{-- MAIN STATISTICS --}}
        <div class="mb-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Platform Overview</h5>
                <span class="text-secondary small">Live database statistics</span>
            </div>

            @php
                $statistics = [
                    ['Total Reports', $totalReports, 'text-danger', 'border-danger'],
                    ['Total Users', $totalUsers, 'text-info', 'border-info'],
                    ['Departments', $totalDepartments, 'text-primary', 'border-primary'],
                    ['Department Officers', $totalOfficers, 'text-warning', 'border-warning'],
                    ['Pending Reports', $pendingReports, 'text-warning', 'border-warning'],
                    ['Under Review', $underReviewReports, 'text-info', 'border-info'],
                    ['In Progress', $inProgressReports, 'text-primary', 'border-primary'],
                    ['Resolved', $resolvedReports, 'text-success', 'border-success'],
                    ['Rejected', $rejectedReports, 'text-danger', 'border-danger'],
                ];
            @endphp

            <div class="row g-3">

                @foreach ($statistics as $stat)
                    <div class="col-12 col-md-6 col-xl-4">

                        <div
                            class="card bg-black text-light border-secondary border-start border-4 {{ $stat[3] }} rounded-3 h-100">

                            <div class="card-body p-4">

                                <p class="text-secondary small fw-semibold text-uppercase mb-3">
                                    {{ $stat[0] }}
                                </p>

                                <h2 class="fw-bold mb-0 {{ $stat[2] }}">
                                    {{ number_format($stat[1]) }}
                                </h2>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>


        {{-- RESOLUTION RATE --}}
        <div class="card bg-black text-light border-secondary rounded-3 mb-5">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">

                    <div>
                        <h5 class="fw-bold mb-1">Resolution Performance</h5>
                        <p class="text-secondary small mb-0">
                            Percentage of reports successfully resolved.
                        </p>
                    </div>

                    <h2 class="fw-bold text-success mb-0">
                        {{ $resolutionRate }}%
                    </h2>

                </div>

                <div class="progress bg-secondary" style="height: 12px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $resolutionRate }}%">
                    </div>
                </div>

            </div>

        </div>


        {{-- DEPARTMENT PERFORMANCE --}}
        <div class="card bg-black text-light border-secondary rounded-3 mb-5">

            <div class="card-header bg-transparent border-secondary p-4">
                <h5 class="fw-bold mb-1">Department Performance</h5>
                <p class="text-secondary small mb-0">
                    Monitor report distribution and resolution across departments.
                </p>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-dark table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="p-3">Department</th>
                                <th>Total Reports</th>
                                <th>In Progress</th>
                                <th>Resolved</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($departmentPerformance as $department)
                                <tr>
                                    <td class="p-3 fw-semibold">
                                        {{ $department->name }}
                                    </td>

                                    <td>
                                        {{ $department->total_reports }}
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $department->in_progress_reports }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            {{ $department->resolved_reports }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center text-secondary p-4">
                                        No department data available.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>


        {{-- CATEGORY INSIGHTS --}}
        <div class="card bg-black text-light border-secondary rounded-3 mb-5">

            <div class="card-header bg-transparent border-secondary p-4">
                <h5 class="fw-bold mb-1">Most Reported Categories</h5>
                <p class="text-secondary small mb-0">
                    Identify the most frequently reported city issues.
                </p>
            </div>

            <div class="card-body p-4">

                @php
                    $maxCategoryReports = max(1, (int) $categoryInsights->max('total_reports'));
                @endphp

                @forelse ($categoryInsights as $category)
                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <span class="fw-semibold">
                                {{ $category->name }}
                            </span>

                            <span class="text-secondary small">
                                {{ $category->total_reports }} reports
                            </span>

                        </div>

                        <div class="progress bg-secondary" style="height: 9px;">

                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ ($category->total_reports / $maxCategoryReports) * 100 }}%">
                            </div>

                        </div>

                    </div>

                @empty

                    <p class="text-secondary mb-0">
                        No category data available.
                    </p>
                @endforelse

            </div>

        </div>


        {{-- RECENT REPORTS --}}
        <div class="card bg-black text-light border-secondary rounded-3 mb-5">

            <div class="card-header bg-transparent border-secondary p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h5 class="fw-bold mb-1">Recent Reports</h5>
                        <p class="text-secondary small mb-0">
                            Latest reports submitted by citizens.
                        </p>
                    </div>

                    <a href="{{ route('admin.reports.index') }}" class="btn btn-danger btn-sm">
                        View All Reports →
                    </a>

                </div>

            </div>

            <div class="card-body p-0">

                @if ($recentReports->isEmpty())

                    <p class="text-secondary p-4 mb-0">
                        No reports have been submitted yet.
                    </p>
                @else
                    <div class="table-responsive">

                        <table class="table table-dark table-hover align-middle mb-0">

                            <thead>
                                <tr>
                                    <th class="p-3">Report</th>
                                    <th>Citizen</th>
                                    <th>Category</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($recentReports as $report)
                                    <tr>

                                        <td class="p-3 fw-semibold">
                                            #{{ $report->id }} — {{ $report->title }}
                                        </td>

                                        <td>{{ $report->user->name }}</td>

                                        <td>{{ $report->category->name }}</td>

                                        <td>
                                            {{ $report->department?->name ?? 'Unassigned' }}
                                        </td>

                                        <td>
                                            <span
                                                class="badge
                                            @if ($report->status->slug === 'resolved') bg-success
                                            @elseif ($report->status->slug === 'rejected') bg-danger
                                            @elseif ($report->status->slug === 'in-progress') bg-primary
                                            @elseif ($report->status->slug === 'under-review') bg-info text-dark
                                            @else bg-warning text-dark @endif">
                                                {{ $report->status->name }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $report->created_at->format('d M Y') }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

        </div>


        {{-- ADMIN NAVIGATION --}}
        <div class="mb-3">

            <h5 class="fw-bold mb-3">Administration & Management</h5>

            <div class="d-flex flex-wrap gap-2">

                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light">
                    Manage Users
                </a>

                <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-light">
                    Manage Departments
                </a>

                <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">
                    Manage All Reports
                </a>

            </div>

        </div>

    </div>

@endsection
