@extends('layouts.app')

@section('title', 'Report Details')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/citizen/reports/show.css') }}">
    @endpush

    <div class="citizen-report-details-page">
        <div class="citizen-report-details-container">

            <header class="citizen-report-details-header">
                <div class="citizen-report-details-heading">
                    <span class="citizen-report-details-eyebrow">CITIZEN PORTAL / REPORT TRACKING</span>
                    <h1>Report Details</h1>
                    <p>Review the information, attachments, and latest activity for your report.</p>
                    <span class="citizen-report-details-reference">REPORT #{{ $report->id }}</span>
                </div>

                <a href="{{ route('citizen.reports.index') }}" class="citizen-report-details-back">
                    <span aria-hidden="true">←</span>
                    Back to My Reports
                </a>
            </header>

            <section class="citizen-report-details-card citizen-report-details-overview">
                <div class="citizen-report-details-card-top">
                    <div class="citizen-report-details-title-group">
                        <span class="citizen-report-details-section-label">REPORT OVERVIEW</span>
                        <h2>{{ $report->title }}</h2>
                        <span class="citizen-report-details-category">{{ $report->category->name }}</span>
                    </div>
                    <span class="citizen-report-details-status">{{ $report->status->name }}</span>
                </div>

                <div class="citizen-report-details-divider"></div>

                <div class="citizen-report-details-description">
                    <h3>Description</h3>
                    <p>{{ $report->description }}</p>
                </div>

                <div class="citizen-report-details-divider"></div>

                <div class="citizen-report-details-information-grid">
                    <div class="citizen-report-details-information-item">
                        <span>Submitted</span>
                        <strong>{{ $report->created_at->format('d M Y, H:i') }}</strong>
                    </div>
                    <div class="citizen-report-details-information-item">
                        <span>Last Updated</span>
                        <strong>{{ $report->updated_at->format('d M Y, H:i') }}</strong>
                    </div>
                    <div class="citizen-report-details-information-item citizen-report-details-address">
                        <span>Address</span>
                        <strong>{{ $report->address ?? 'No address provided' }}</strong>
                    </div>
                    <div class="citizen-report-details-information-item">
                        <span>Latitude</span>
                        <strong>{{ $report->latitude }}</strong>
                    </div>
                    <div class="citizen-report-details-information-item">
                        <span>Longitude</span>
                        <strong>{{ $report->longitude }}</strong>
                    </div>
                </div>
            </section>

            <section class="citizen-report-details-card citizen-report-details-attachments">
                <div class="citizen-report-details-section-heading">
                    <div>
                        <span class="citizen-report-details-section-label">SUPPORTING EVIDENCE</span>
                        <h2>Attachments</h2>
                    </div>
                    <span class="citizen-report-details-count">{{ $report->images->count() }} files</span>
                </div>

                @forelse($report->images as $image)
                    <div class="citizen-report-details-attachment">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Report attachment"
                            class="citizen-report-details-image">
                        <p>{{ $image->original_name }}</p>
                    </div>
                @empty
                    <div class="citizen-report-details-empty">
                        <span class="citizen-report-details-empty-icon" aria-hidden="true">▧</span>
                        <p>No images attached to this report.</p>
                    </div>
                @endforelse
            </section>

            <section class="citizen-report-details-card citizen-report-details-activity">
                <div class="citizen-report-details-section-heading">
                    <div>
                        <span class="citizen-report-details-section-label">PROGRESS HISTORY</span>
                        <h2>Report Activity</h2>
                    </div>
                </div>

                <div class="citizen-report-details-timeline">
                    @forelse($report->activities as $activity)
                        <article class="citizen-report-details-timeline-item">
                            <span class="citizen-report-details-timeline-marker" aria-hidden="true"></span>
                            <div class="citizen-report-details-timeline-content">
                                <h3>{{ str($activity->activity_type->value)->replace('_', ' ')->title() }}</h3>
                                <p>{{ $activity->description }}</p>
                                <small>
                                    {{ $activity->created_at->format('d M Y, H:i') }}
                                    @if ($activity->user)
                                        · {{ $activity->user->name }}
                                    @endif
                                </small>

                                @if ($activity->oldStatus || $activity->newStatus)
                                    <div class="citizen-report-details-status-change">
                                        @if ($activity->oldStatus)
                                            <span>{{ $activity->oldStatus->name }}</span>
                                        @endif
                                        @if ($activity->oldStatus && $activity->newStatus)
                                            <span class="citizen-report-details-status-arrow">→</span>
                                        @endif
                                        @if ($activity->newStatus)
                                            <span>{{ $activity->newStatus->name }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="citizen-report-details-empty">
                            <span class="citizen-report-details-empty-icon" aria-hidden="true">◷</span>
                            <p>No activity recorded yet.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <footer class="citizen-report-details-footer">
                <span>CityPulse · Citizen Report Tracking</span>
                <span>Keeping your city informed.</span>
            </footer>

        </div>
    </div>

@endsection
