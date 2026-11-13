@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid py-4 text-light">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">CityPulse Administration</h1>
                <p class="text-secondary mb-0">
                    Welcome, {{ auth()->user()->name }}.
                    System overview and management.
                </p>
            </div>

            <span class="badge bg-danger fs-6">Administrator</span>
        </div>

        <div class="row g-3 mb-4">

            @php
                $statistics = [
                    ['Total Reports', $totalReports, 'bi-file-earmark-text'],
                    ['Total Users', $totalUsers, 'bi-people'],
                    ['Departments', $totalDepartments, 'bi-building'],
                    ['Department Officers', $totalOfficers, 'bi-person-badge'],
                    ['Pending Reports', $pendingReports, 'bi-clock-history'],
                    ['Resolved Reports', $resolvedReports, 'bi-check-circle'],
                ];
            @endphp

            @foreach ($statistics as $stat)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card bg-black text-light border-secondary h-100">
                        <div class="card-body p-4">
                            <p class="text-secondary mb-2">{{ $stat[0] }}</p>
                            <h2 class="fw-bold mb-0">{{ $stat[1] }}</h2>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="card bg-black text-light border-secondary">
            <div class="card-header border-secondary py-3">
                <h5 class="mb-0">Recent Reports</h5>
            </div>

            <div class="card-body">
                @if ($recentReports->isEmpty())
                    <p class="text-secondary mb-0">No reports have been submitted yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Report</th>
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
                                        <td>#{{ $report->id }} — {{ $report->title }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td>{{ $report->category->name }}</td>
                                        <td>{{ $report->department?->name ?? 'Unassigned' }}</td>
                                        <td>{{ $report->status->name }}</td>
                                        <td>{{ $report->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light">
            Manage Users
        </a>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-light">
            Manage Departments
        </a>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">
            Manage All Reports
        </a>


        <div class="mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger">Logout</button>
            </form>
        </div>

    </div>
@endsection
