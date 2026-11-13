@extends('layouts.app')

@section('title', 'Department Officer Dashboard')

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold">Department Officer Dashboard</h2>
                <p class="text-muted mb-0">
                    Welcome, {{ auth()->user()->name }}.
                    Manage and monitor your department's reports.
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    Logout
                </button>
            </form>
        </div>

        <div class="row g-4 mb-5">

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Total Reports</h6>
                        <h2 class="fw-bold">{{ $totalReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Pending Review</h6>
                        <h2 class="fw-bold text-warning">{{ $pendingReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">In Progress</h6>
                        <h2 class="fw-bold text-primary">{{ $inProgressReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Resolved</h6>
                        <h2 class="fw-bold text-success">{{ $resolvedReports }}</h2>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h5 class="mb-0">Recent Department Reports</h5>
                <a href="{{ route('officer.reports.index') }}" class="btn btn-danger">
                    View All Reports
                </a>
            </div>

            <div class="card-body">

                @if ($recentReports->isEmpty())
                    <div class="text-center py-4">
                        <p class="text-muted mb-0">
                            No reports have been assigned to your department yet.
                        </p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Report</th>
                                    <th>Category</th>
                                    <th>Citizen</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($recentReports as $report)
                                    <tr>
                                        <td>
                                            <strong>{{ $report->title }}</strong>
                                        </td>

                                        <td>{{ $report->category->name }}</td>

                                        <td>{{ $report->user->name }}</td>

                                        <td>
                                            <span class="badge bg-secondary">
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

    </div>
@endsection
