@extends('layouts.app')

@section('title', 'Officer Command Center')

@section('content')

    <div class="officer-dashboard py-4 py-lg-5" style="background: var(--cp-bg); min-height: calc(100vh - 72px);">
        <div class="container">
            <section class="dashboard-hero mb-4 mb-lg-5">
                <div class="hero-content d-flex flex-wrap justify-content-between align-items-center gap-4">
                    <div>
                        <div class="eyebrow">CityPulse <span>•</span> Operations portal</div>
                        <h1 class="hero-title">Officer Command Center</h1>
                        <p class="hero-subtitle mb-0">
                            Welcome back, {{ auth()->user()->name }}. Here's your department's latest activity and report
                            overview.
                        </p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <span class="hero-status"><span class="status-dot"></span> Department workspace</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-logout px-3 py-2">Log out</button>
                        </form>
                    </div>
                </div>
            </section>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div class="section-label">Department overview</div>
                    <h2 class="h5 fw-bold mb-0 mt-1">Report statistics</h2>
                </div>
            </div>

            <div class="row g-3 g-xl-4 mb-4 mb-lg-5">
                <div class="col-6 col-xl-3">
                    <div class="metric-card metric-total">
                        <div class="metric-top">
                            <span class="section-label">Total reports</span>
                            <span class="metric-icon">▤</span>
                        </div>
                        <div class="metric-number">{{ $totalReports }}</div>
                        <div class="metric-caption">Reports received by your department</div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="metric-card metric-pending">
                        <div class="metric-top">
                            <span class="section-label">Pending review</span>
                            <span class="metric-icon">◷</span>
                        </div>
                        <div class="metric-number">{{ $pendingReports }}</div>
                        <div class="metric-caption">Waiting for officer attention</div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="metric-card metric-progress">
                        <div class="metric-top">
                            <span class="section-label">In progress</span>
                            <span class="metric-icon">↗</span>
                        </div>
                        <div class="metric-number">{{ $inProgressReports }}</div>
                        <div class="metric-caption">Currently being addressed</div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="metric-card metric-resolved">
                        <div class="metric-top">
                            <span class="section-label">Resolved</span>
                            <span class="metric-icon">✓</span>
                        </div>
                        <div class="metric-number">{{ $resolvedReports }}</div>
                        <div class="metric-caption">Successfully completed reports</div>
                    </div>
                </div>
            </div>

            <section class="reports-panel">
                <div class="panel-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="section-label mb-1">Latest activity</div>
                        <h2 class="panel-title">Recent department reports</h2>
                        <p class="panel-subtitle">A quick look at the newest reports assigned to your department.</p>
                    </div>
                    <a href="{{ route('officer.reports.index') }}" class="btn btn-dashboard">View all reports <span
                            aria-hidden="true">→</span></a>
                </div>

                @if ($recentReports->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">⌕</div>
                        <h3 class="h6 fw-bold mb-2">No reports yet</h3>
                        <p class="text-muted mb-0">There are currently no reports assigned to your department.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Report</th>
                                    <th>Category</th>
                                    <th>Submitted by</th>
                                    <th>Status</th>
                                    <th>Date submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentReports as $report)
                                    <tr>
                                        <td>
                                            <span class="report-title">{{ $report->title }}</span>
                                            <span class="report-id">Report #{{ $report->id }}</span>
                                        </td>
                                        <td>{{ $report->category->name }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td><span class="status-badge">{{ $report->status->name }}</span></td>
                                        <td>{{ $report->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <div class="text-center mt-4">
                <small class="text-muted">CityPulse · Department operations</small>
            </div>
        </div>
    </div>
@endsection
