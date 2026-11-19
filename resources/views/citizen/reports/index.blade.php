@extends('layouts.app')

@section('title', 'My Reports')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/citizen/reports/index.css') }}">
    @endpush

    <div class="citizen-reports-page">
        <div class="citizen-reports-container">

            <header class="citizen-reports-header">
                <div class="citizen-reports-heading">
                    <span class="citizen-reports-eyebrow">CITIZEN PORTAL / REPORT CENTER</span>
                    <h1>My Reports</h1>
                    <p>Track the reports you have submitted and follow their progress.</p>
                </div>

                <a href="{{ route('citizen.dashboard') }}" class="citizen-reports-back">
                    <span aria-hidden="true">←</span>
                    Back to Dashboard
                </a>
            </header>

            @if (session('success'))
                <div class="citizen-reports-alert citizen-reports-alert-success" role="status">
                    <span class="citizen-reports-alert-icon" aria-hidden="true">✓</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if (session('ai_suggestion'))
                <div class="citizen-reports-alert citizen-reports-alert-ai">
                    <div class="citizen-reports-ai-icon" aria-hidden="true">✦</div>
                    <div class="citizen-reports-ai-content">
                        <span class="citizen-reports-section-label">CITYPULSE INTELLIGENCE</span>
                        <h2>AI Analysis</h2>
                        <div class="citizen-reports-ai-details">
                            <p>
                                <strong>Suggested category</strong>
                                <span>{{ session('ai_suggestion.category') }}</span>
                            </p>
                            <p>
                                <strong>Model confidence</strong>
                                <span>{{ number_format((float) session('ai_suggestion.confidence') * 100, 2) }}%</span>
                            </p>
                        </div>
                        <small>This is an AI recommendation. Your selected category remains unchanged.</small>
                    </div>
                </div>
            @endif

            <section class="citizen-reports-card">
                <div class="citizen-reports-card-heading">
                    <div>
                        <span class="citizen-reports-section-label">YOUR SUBMISSIONS</span>
                        <h2>Report History</h2>
                    </div>
                    <span class="citizen-reports-card-mark" aria-hidden="true">CP</span>
                </div>

                <div class="citizen-reports-list">
                    @forelse($reports as $report)
                        <article class="citizen-reports-item">
                            <div class="citizen-reports-item-main">
                                <div class="citizen-reports-item-title-row">
                                    <h3>{{ $report->title }}</h3>
                                    <span class="citizen-reports-status">{{ $report->status->name }}</span>
                                </div>
                                <span class="citizen-reports-category">{{ $report->category->name }}</span>
                            </div>

                            <a href="{{ route('citizen.reports.show', $report) }}" class="citizen-reports-view-link">
                                View Details
                                <span aria-hidden="true">→</span>
                            </a>
                        </article>
                    @empty
                        <div class="citizen-reports-empty">
                            <span class="citizen-reports-empty-icon" aria-hidden="true">▤</span>
                            <h3>No reports yet</h3>
                            <p>You haven't submitted any reports yet.</p>
                        </div>
                    @endforelse
                </div>

                <div class="citizen-reports-pagination">
                    {{ $reports->links() }}
                </div>
            </section>

            <footer class="citizen-reports-footer">
                <span>CityPulse · Citizen Report Center</span>
                <span>Your voice helps improve the city.</span>
            </footer>

        </div>
    </div>

@endsection
