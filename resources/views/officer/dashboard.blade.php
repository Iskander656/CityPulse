@extends('layouts.app')

@section('title', 'Officer Command Center')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/officer/dashboard.css') }}">
    @endpush

    <div class="officer-dashboard-page">
        <div class="container-fluid officer-dashboard-container">
            <header class="officer-dashboard-header">
                <div class="officer-header-copy">
                    <div class="officer-eyebrow"><span class="officer-eyebrow-dot"></span> CITYPULSE / DEPARTMENT OPERATIONS
                    </div>
                    <h1>Officer Command Center</h1>
                    <p>Welcome back, {{ auth()->user()->name }}. Here's your department's latest activity and report
                        overview.</p>
                </div>

                <div class="officer-header-actions">
                    <div class="officer-workspace-status"><span></span> Department workspace</div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="officer-logout-button">Log out <span
                                aria-hidden="true">↗</span></button>
                    </form>
                </div>
            </header>

            <section class="officer-section-block">
                <div class="officer-section-heading">
                    <div>
                        <span class="officer-section-kicker">PERFORMANCE SNAPSHOT</span>
                        <h2>Department overview</h2>
                        <p>Current report activity across your department.</p>
                    </div>
                    <div class="officer-live-indicator"><span></span> LIVE OVERVIEW</div>
                </div>

                <div class="row g-3 officer-metrics-grid">
                    <div class="col-6 col-xl-3">
                        <article class="officer-metric-card officer-metric-total">
                            <div class="officer-metric-top"><span>Total reports</span><span
                                    class="officer-metric-icon">▤</span></div>
                            <div class="officer-metric-value">{{ $totalReports }}</div>
                            <div class="officer-metric-foot">Reports received by your department</div>
                            <div class="officer-metric-track"><span></span></div>
                        </article>
                    </div>
                    <div class="col-6 col-xl-3">
                        <article class="officer-metric-card officer-metric-pending">
                            <div class="officer-metric-top"><span>Pending review</span><span
                                    class="officer-metric-icon">◷</span></div>
                            <div class="officer-metric-value">{{ $pendingReports }}</div>
                            <div class="officer-metric-foot">Waiting for officer attention</div>
                            <div class="officer-metric-track"><span></span></div>
                        </article>
                    </div>
                    <div class="col-6 col-xl-3">
                        <article class="officer-metric-card officer-metric-progress">
                            <div class="officer-metric-top"><span>In progress</span><span
                                    class="officer-metric-icon">↗</span></div>
                            <div class="officer-metric-value">{{ $inProgressReports }}</div>
                            <div class="officer-metric-foot">Currently being addressed</div>
                            <div class="officer-metric-track"><span></span></div>
                        </article>
                    </div>
                    <div class="col-6 col-xl-3">
                        <article class="officer-metric-card officer-metric-resolved">
                            <div class="officer-metric-top"><span>Resolved</span><span class="officer-metric-icon">✓</span>
                            </div>
                            <div class="officer-metric-value">{{ $resolvedReports }}</div>
                            <div class="officer-metric-foot">Successfully completed reports</div>
                            <div class="officer-metric-track"><span></span></div>
                        </article>
                    </div>
                </div>
            </section>

            <section class="officer-reports-panel">
                <div class="officer-panel-header">
                    <div>
                        <span class="officer-section-kicker">RECENT ACTIVITY</span>
                        <h2>Recent department reports</h2>
                        <p>A quick look at the newest reports assigned to your department.</p>
                    </div>
                    <a href="{{ route('officer.reports.index') }}" class="officer-view-all">View all reports <span
                            aria-hidden="true">→</span></a>
                </div>

                @if ($recentReports->isEmpty())
                    <div class="officer-empty-state">
                        <div class="officer-empty-icon">⌕</div>
                        <h3>No reports yet</h3>
                        <p>There are currently no reports assigned to your department.</p>
                    </div>
                @else
                    <div class="table-responsive officer-table-wrap">
                        <table class="table officer-reports-table align-middle">
                            <thead>
                                <tr>
                                    <th>REPORT</th>
                                    <th>CATEGORY</th>
                                    <th>SUBMITTED BY</th>
                                    <th>STATUS</th>
                                    <th>DATE SUBMITTED</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentReports as $report)
                                    <tr>
                                        <td>
                                            <span class="officer-report-title">{{ $report->title }}</span>
                                            <span class="officer-report-id">REPORT #{{ $report->id }}</span>
                                        </td>
                                        <td>{{ $report->category->name }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td><span class="officer-status-badge">{{ $report->status->name }}</span></td>
                                        <td>{{ $report->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <footer class="officer-dashboard-footer">CITYPULSE <span>•</span> DEPARTMENT OPERATIONS</footer>
        </div>
    </div>
@endsection
