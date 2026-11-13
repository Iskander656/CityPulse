@extends('layouts.app')

@section('title', 'Global Report Management')

@section('content')
    <div class="container-fluid py-4 text-light">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h1 class="fw-bold">Global Report Management</h1>
                <p class="text-secondary mb-0">
                    Monitor and manage every report submitted to CityPulse.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-danger fs-6">Administrator</span>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">
                    ← Back to Dashboard
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card bg-black border-secondary text-light mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3">

                    <div class="col-lg-3">
                        <input type="text" name="search" class="form-control bg-dark text-light border-secondary"
                            placeholder="Search reports or citizens..." value="{{ request('search') }}">
                    </div>

                    <div class="col-lg-2">
                        <select name="status_id" class="form-select bg-dark text-light border-secondary">
                            <option value="">All Statuses</option>

                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @selected(request('status_id') == $status->id)>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <select name="category_id" class="form-select bg-dark text-light border-secondary">
                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <select name="department_id" class="form-select bg-dark text-light border-secondary">
                            <option value="">All Departments</option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @selected(request('department_id') == $department->id)>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 d-grid">
                        <button class="btn btn-outline-light">Apply Filters</button>
                    </div>

                </form>

            </div>
        </div>

        <div class="card bg-black border-secondary text-light">

            <div class="card-header border-secondary py-3">
                <h5 class="mb-0">All Submitted Reports</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Report</th>
                                <th>Citizen</th>
                                <th>Category</th>
                                <th>Department</th>
                                <th>Officer</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($reports as $report)
                                <tr>
                                    <td>#{{ $report->id }}</td>

                                    <td>{{ $report->title }}</td>

                                    <td>{{ $report->user->name }}</td>

                                    <td>{{ $report->category->name }}</td>

                                    <td>
                                        {{ $report->department?->name ?? 'Unassigned' }}
                                    </td>

                                    <td>
                                        {{ $report->assignedOfficer?->name ?? 'Unassigned' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $report->status->name }}
                                        </span>
                                    </td>

                                    <td>{{ $report->created_at->format('d M Y') }}</td>

                                    <td>
                                        <a href="{{ route('admin.reports.show', $report) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            Review
                                        </a>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="9" class="text-center text-secondary py-4">
                                        No reports found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

                {{ $reports->links() }}

            </div>
        </div>

    </div>
@endsection
