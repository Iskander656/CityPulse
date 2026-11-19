@extends('layouts.app')

@section('title', 'Review Report')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/officer/reports/show.css') }}">
@endpush

@section('content')
    <div class="officer-report-show-page">
        <div class="container officer-report-show-container">

            <div class="officer-report-show-topbar">
                <div>
                    <span class="officer-report-show-eyebrow">Department Operations / Report Review</span>
                    <h1>Report Details</h1>
                    <p>Review the submitted information, update its status, and track activity.</p>
                </div>

                <a href="{{ route('officer.reports.index') }}" class="officer-report-show-back">
                    <span aria-hidden="true">←</span>
                    Back to Reports
                </a>
            </div>

            @if (session('success'))
                <div class="officer-report-show-alert officer-report-show-alert-success" role="alert">
                    <span class="officer-report-show-alert-icon" aria-hidden="true">✓</span>
                    {{ session('success') }}
                </div>
            @endif

            <section class="officer-report-show-card officer-report-show-details-card">
                <div class="officer-report-show-card-heading">
                    <div>
                        <span class="officer-report-show-section-label">Submitted Report</span>
                        <h2>{{ $report->title }}</h2>
                        <p class="officer-report-show-meta">
                            Report #{{ $report->id }}
                            <span>·</span>
                            Submitted {{ $report->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    <div class="officer-report-show-current-status">
                        <span>Current status</span>
                        <strong>{{ $report->status->name }}</strong>
                    </div>
                </div>

                <div class="officer-report-show-divider"></div>

                <div class="officer-report-show-information-grid">
                    <div class="officer-report-show-information-item">
                        <span>Citizen</span>
                        <strong>{{ $report->user->name }}</strong>
                    </div>
                    <div class="officer-report-show-information-item">
                        <span>Category</span>
                        <strong>{{ $report->category->name }}</strong>
                    </div>
                    <div class="officer-report-show-information-item">
                        <span>Address</span>
                        <strong>{{ $report->address ?? 'Not provided' }}</strong>
                    </div>
                    <div class="officer-report-show-information-item">
                        <span>Latitude</span>
                        <strong>{{ $report->latitude }}</strong>
                    </div>
                    <div class="officer-report-show-information-item">
                        <span>Longitude</span>
                        <strong>{{ $report->longitude }}</strong>
                    </div>
                </div>

                <div class="officer-report-show-description">
                    <span class="officer-report-show-section-label">Description</span>
                    <p>{{ $report->description }}</p>
                </div>

                @if ($report->images->isNotEmpty())
                    <div class="officer-report-show-attachments">
                        <div class="officer-report-show-subheading">
                            <div>
                                <span class="officer-report-show-section-label">Evidence</span>
                                <h3>Attached Images</h3>
                            </div>
                            <span class="officer-report-show-attachment-count">{{ $report->images->count() }}
                                {{ $report->images->count() === 1 ? 'image' : 'images' }}</span>
                        </div>

                        <div class="officer-report-show-image-grid">
                            @foreach ($report->images as $image)
                                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank"
                                    rel="noopener noreferrer" class="officer-report-show-image-link">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Report image">
                                    <span>View image ↗</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>

            <section class="officer-report-show-card officer-report-show-update-card">
                <div class="officer-report-show-card-title">
                    <div>
                        <span class="officer-report-show-section-label">Case Management</span>
                        <h2>Update Report</h2>
                        <p>Record the latest progress and keep the citizen informed.</p>
                    </div>
                    <span class="officer-report-show-title-mark" aria-hidden="true">↗</span>
                </div>

                @if ($errors->any())
                    <div class="officer-report-show-alert officer-report-show-alert-error" role="alert">
                        <strong>Please review the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($report->status->is_final)
                    <div class="officer-report-show-closed-notice">
                        <span aria-hidden="true">✓</span>
                        <div>
                            <strong>This report is closed</strong>
                            <p>This report is closed and cannot be updated.</p>
                        </div>
                    </div>
                @else
                    <form method="POST" action="{{ route('officer.reports.update', $report) }}"
                        class="officer-report-show-form">
                        @csrf
                        @method('PATCH')

                        <div class="officer-report-show-form-group">
                            <label for="officer-report-status" class="officer-report-show-label">New Status</label>
                            <select id="officer-report-status" name="status_id" class="officer-report-show-control"
                                required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id', $report->status_id) == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="officer-report-show-form-group">
                            <label for="officer-report-notes" class="officer-report-show-label">Update Notes</label>
                            <textarea id="officer-report-notes" name="notes" class="officer-report-show-control officer-report-show-textarea"
                                rows="4" maxlength="1000" placeholder="Describe the progress or action taken...">{{ old('notes') }}</textarea>
                            <small class="officer-report-show-help">These updates are also visible in the citizen's activity
                                timeline.</small>
                        </div>

                        <div class="officer-report-show-form-actions">
                            <button type="submit" class="officer-report-show-submit">
                                Save Update <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                @endif
            </section>

            <section class="officer-report-show-card officer-report-show-activity-card">
                <div class="officer-report-show-card-title">
                    <div>
                        <span class="officer-report-show-section-label">Report Timeline</span>
                        <h2>Activity History</h2>
                        <p>A chronological record of actions and updates.</p>
                    </div>
                    <span class="officer-report-show-title-mark" aria-hidden="true">◷</span>
                </div>

                <div class="officer-report-show-timeline">
                    @forelse ($report->activities->sortByDesc('created_at') as $activity)
                        <article class="officer-report-show-activity">
                            <span class="officer-report-show-timeline-dot" aria-hidden="true"></span>
                            <div class="officer-report-show-activity-content">
                                <div class="officer-report-show-activity-heading">
                                    <strong>{{ str($activity->activity_type->value)->replace('_', ' ')->title() }}</strong>
                                    <time>{{ $activity->created_at->format('d M Y H:i') }}</time>
                                </div>
                                <p>{{ $activity->description }}</p>
                                <span class="officer-report-show-activity-user">By
                                    {{ $activity->user->name ?? 'System' }}</span>
                            </div>
                        </article>
                    @empty
                        <div class="officer-report-show-no-activity">
                            <span aria-hidden="true">◷</span>
                            <p>No activity recorded.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <div class="officer-report-show-footer">
                <span>CityPulse</span>
                <span>Officer Workspace · Report Review</span>
            </div>

        </div>
    </div>
@endsection
