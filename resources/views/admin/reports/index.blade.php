@extends('layouts.app')

@section('title', 'Global Report Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/reports/reports.css') }}">
@endpush

@section('content')
    <div class="admin-reports-page container-fluid py-4">
        <div class="admin-reports-header">
            <div class="admin-reports-header__content">
                <span class="admin-reports-eyebrow">CITYPULSE / ADMINISTRATION</span>
                <h1 class="admin-reports-header__title">Global Report Management</h1>
                <p class="admin-reports-header__subtitle">
                    Monitor, review, and manage every report submitted to CityPulse.
                </p>
            </div>

            <div class="admin-reports-header__actions">
                <span class="admin-reports-role-badge">
                    <i class="bi bi-shield-lock-fill"></i>
                    Administrator
                </span>
                <a href="{{ route('admin.dashboard') }}" class="admin-reports-back-link">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="admin-reports-alert" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <section class="admin-reports-filter-card">
            <div class="admin-reports-section-heading">
                <div class="admin-reports-section-heading__icon">
                    <i class="bi bi-funnel-fill"></i>
                </div>
                <div>
                    <h2 class="admin-reports-section-heading__title">Filter reports</h2>
                    <p class="admin-reports-section-heading__subtitle">Narrow down the global report register.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.reports.index') }}" class="admin-reports-filter-form">
                <div class="admin-reports-field admin-reports-field--search">
                    <label for="report-search">Search</label>
                    <div class="admin-reports-input-wrap">
                        <i class="bi bi-search"></i>
                        <input id="report-search" type="text" name="search"
                            placeholder="Search reports or citizens..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="admin-reports-field">
                    <label for="report-status">Status</label>
                    <select id="report-status" name="status_id">
                        <option value="">All Statuses</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @selected(request('status_id') == $status->id)>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-reports-field">
                    <label for="report-category">Category</label>
                    <select id="report-category" name="category_id">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-reports-field">
                    <label for="report-department">Department</label>
                    <select id="report-department" name="department_id">
                        <option value="">All Departments</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @selected(request('department_id') == $department->id)>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-reports-filter-actions">
                    <button type="submit" class="admin-reports-filter-button">
                        <i class="bi bi-sliders"></i>
                        Apply Filters
                    </button>
                </div>
            </form>
        </section>

        <section class="admin-reports-table-card">
            <div class="admin-reports-table-header">
                <div>
                    <span class="admin-reports-table-header__eyebrow">REPORT REGISTER</span>
                    <h2 class="admin-reports-table-header__title">All Submitted Reports</h2>
                    <p class="admin-reports-table-header__subtitle">Review report ownership, classification, and current status.</p>
                </div>
                <div class="admin-reports-table-header__icon">
                    <i class="bi bi-clipboard-data"></i>
                </div>
            </div>

            <div class="admin-reports-table-wrap">
                <table class="admin-reports-table">
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
                                <td><span class="admin-reports-id">#{{ $report->id }}</span></td>
                                <td><span class="admin-reports-report-title">{{ $report->title }}</span></td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->category->name }}</td>
                                <td>{{ $report->department?->name ?? 'Unassigned' }}</td>
                                <td>{{ $report->assignedOfficer?->name ?? 'Unassigned' }}</td>
                                <td>
                                    <span class="admin-reports-status">
                                        <span class="admin-reports-status__dot"></span>
                                        {{ $report->status->name }}
                                    </span>
                                </td>
                                <td><span class="admin-reports-date">{{ $report->created_at->format('d M Y') }}</span></td>
                                <td>
                                    <a href="{{ route('admin.reports.show', $report) }}" class="admin-reports-review-button">
                                        Review
                                        <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="admin-reports-empty">
                                    <span class="admin-reports-empty__icon"><i class="bi bi-inbox"></i></span>
                                    <strong>No reports found</strong>
                                    <span>Try adjusting your filters or search terms.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="admin-reports-pagination">
                {{ $reports->links() }}
            </div>
        </section>
    </div>
@endsection
