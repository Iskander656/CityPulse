@extends('layouts.app')

@section('title', 'Report Details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/reports/report-details.css') }}">
@endpush

@section('content')
    <div class="admin-report-details-page">
        <header class="admin-report-details-header">
            <div class="admin-report-details-header__main">
                <span class="admin-report-details-eyebrow">CITYPULSE / REPORT MANAGEMENT</span>
                <h1 class="admin-report-details-header__title">Report <span>#{{ $report->id }}</span></h1>
                <p class="admin-report-details-header__subtitle">Review the submitted issue, inspect AI recommendations, and
                    manage its assignment.</p>
            </div>

            <a href="{{ route('admin.reports.index') }}" class="admin-report-details-back">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Reports</span>
            </a>
        </header>

        @if (session('success'))
            <div class="admin-report-details-alert" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="admin-report-details-grid">
            <main class="admin-report-details-main">
                <section class="admin-report-card admin-report-overview-card">
                    <div class="admin-report-card__header">
                        <div>
                            <span class="admin-report-card__eyebrow">SUBMISSION OVERVIEW</span>
                            <h2 class="admin-report-card__title">{{ $report->title }}</h2>
                        </div>
                        <span class="admin-report-record-id">#{{ $report->id }}</span>
                    </div>

                    <div class="admin-report-overview-content">
                        <div class="admin-report-detail-block admin-report-detail-block--full">
                            <span class="admin-report-detail-label">Description</span>
                            <p class="admin-report-description">{{ $report->description }}</p>
                        </div>

                        <div class="admin-report-info-grid">
                            <div class="admin-report-detail-block">
                                <span class="admin-report-detail-label"><i class="bi bi-tag"></i> Category</span>
                                <strong class="admin-report-detail-value">{{ $report->category->name }}</strong>
                            </div>
                            <div class="admin-report-detail-block">
                                <span class="admin-report-detail-label"><i class="bi bi-person"></i> Citizen</span>
                                <strong class="admin-report-detail-value">{{ $report->user->name }}</strong>
                            </div>
                            <div class="admin-report-detail-block admin-report-detail-block--full">
                                <span class="admin-report-detail-label"><i class="bi bi-geo-alt"></i> Address</span>
                                <strong class="admin-report-detail-value">{{ $report->address ?? 'Not provided' }}</strong>
                            </div>
                            <div class="admin-report-detail-block">
                                <span class="admin-report-detail-label"><i class="bi bi-crosshair"></i> Coordinates</span>
                                <strong class="admin-report-detail-value admin-report-coordinates">{{ $report->latitude }},
                                    {{ $report->longitude }}</strong>
                            </div>
                            <div class="admin-report-detail-block">
                                <span class="admin-report-detail-label"><i class="bi bi-activity"></i> Current Status</span>
                                <span class="admin-report-current-status">{{ $report->status->name }}</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="admin-report-card admin-report-ai-card">
                    <div class="admin-report-card__header">
                        <div class="admin-report-card__heading-with-icon">
                            <span class="admin-report-section-icon admin-report-section-icon--ai"><i
                                    class="bi bi-robot"></i></span>
                            <div>
                                <span class="admin-report-card__eyebrow">INTELLIGENCE INSIGHTS</span>
                                <h2 class="admin-report-card__title">CityPulse AI Analysis</h2>
                            </div>
                        </div>
                        <span class="admin-report-ai-badge">AI ANALYSIS</span>
                    </div>

                    <div class="admin-report-card__body">
                        @if ($report->ai_suggested_category !== null)
                            <div class="admin-report-ai-comparison">
                                <div class="admin-report-ai-result">
                                    <span class="admin-report-detail-label">Citizen-selected category</span>
                                    <strong>{{ $report->category->name }}</strong>
                                </div>
                                <div class="admin-report-ai-result">
                                    <span class="admin-report-detail-label">AI-suggested category</span>
                                    <strong>{{ $report->ai_suggested_category }}</strong>
                                </div>
                                <div class="admin-report-ai-result admin-report-ai-result--confidence">
                                    <span class="admin-report-detail-label">Model confidence score</span>
                                    <strong>{{ number_format((float) $report->ai_confidence * 100, 2) }}<small>%</small></strong>
                                </div>
                            </div>

                            <div class="admin-report-ai-verdict">
                                @if ($report->category->name === $report->ai_suggested_category)
                                    <span class="admin-report-ai-verdict__icon admin-report-ai-verdict__icon--success"><i
                                            class="bi bi-check-lg"></i></span>
                                    <span>AI recommendation matches citizen category</span>
                                @else
                                    <span class="admin-report-ai-verdict__icon admin-report-ai-verdict__icon--warning"><i
                                            class="bi bi-exclamation-lg"></i></span>
                                    <span>AI recommendation differs — review suggested</span>
                                @endif
                            </div>
                        @else
                            <div class="admin-report-ai-unavailable">
                                <i class="bi bi-info-circle"></i>
                                <p>AI analysis is not available for this report.</p>
                            </div>
                        @endif

                        <p class="admin-report-ai-disclaimer"><i class="bi bi-shield-check"></i> AI provides a
                            recommendation only. The citizen-selected category remains unchanged unless an administrator
                            reviews and updates it.</p>
                    </div>
                </section>

                {{-- AI OFFICER ASSIGNMENT --}}
                @if ($report->assignedOfficer)
                    <div class="admin-report-card">

                        <div class="admin-report-card__header">

                            <div class="admin-report-card__heading-with-icon">

                                <div class="admin-report-section-icon admin-report-section-icon--assignment">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>

                                <div>
                                    <span class="admin-report-card__eyebrow">
                                        INTELLIGENCE INSIGHTS
                                    </span>

                                    <h3 class="admin-report-card__title">
                                        AI Officer Assignment
                                    </h3>
                                </div>

                            </div>

                            <span class="admin-report-ai-badge">
                                AUTOMATED
                            </span>

                        </div>

                        <div class="admin-report-card__body">

                            <div class="admin-report-info-grid">

                                <div class="admin-report-detail-block">
                                    <span class="admin-report-detail-label">
                                        <i class="bi bi-person"></i>
                                        ASSIGNED OFFICER
                                    </span>

                                    <span class="admin-report-detail-value">
                                        {{ $report->assignedOfficer->name }}
                                    </span>
                                </div>

                                <div class="admin-report-detail-block">
                                    <span class="admin-report-detail-label">
                                        <i class="bi bi-building"></i>
                                        ASSIGNED DEPARTMENT
                                    </span>

                                    <span class="admin-report-detail-value">
                                        {{ \App\Models\Department::find($report->assigned_department_id)?->name ?? 'Unassigned' }}
                                    </span>
                                </div>

                            </div>

                            <div class="admin-report-detail-block mt-3">

                                <span class="admin-report-detail-label">
                                    <i class="bi bi-cpu"></i>
                                    AI ASSIGNMENT DECISION
                                </span>

                                <p class="admin-report-description">
                                    The officer was selected based on department compatibility
                                    and relative workload among eligible officers.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <section class="admin-report-card admin-report-images-card">
                    <div class="admin-report-card__header">
                        <div class="admin-report-card__heading-with-icon">
                            <span class="admin-report-section-icon admin-report-section-icon--images"><i
                                    class="bi bi-images"></i></span>
                            <div>
                                <span class="admin-report-card__eyebrow">VISUAL EVIDENCE</span>
                                <h2 class="admin-report-card__title">Report Images</h2>
                            </div>
                        </div>
                    </div>

                    <div class="admin-report-card__body">
                        <div class="admin-report-image-grid">
                            @forelse($report->images as $image)
                                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank"
                                    rel="noopener noreferrer" class="admin-report-image-link">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="admin-report-image"
                                        alt="Report image">
                                    <span class="admin-report-image-overlay"><i class="bi bi-arrows-fullscreen"></i> View
                                        image</span>
                                </a>
                            @empty
                                <div class="admin-report-empty-state admin-report-empty-state--images">
                                    <span class="admin-report-empty-state__icon"><i class="bi bi-image"></i></span>
                                    <strong>No images attached</strong>
                                    <span>This report was submitted without visual evidence.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </main>

            <aside class="admin-report-details-sidebar">
                <section class="admin-report-card admin-report-assignment-card">
                    <div class="admin-report-card__header">
                        <div class="admin-report-card__heading-with-icon">
                            <span class="admin-report-section-icon admin-report-section-icon--assignment"><i
                                    class="bi bi-diagram-3"></i></span>
                            <div>
                                <span class="admin-report-card__eyebrow">WORKFORCE CONTROL</span>
                                <h2 class="admin-report-card__title">Assignment Management</h2>
                            </div>
                        </div>
                    </div>

                    <div class="admin-report-card__body">
                        <div class="admin-report-current-assignment">
                            <div class="admin-report-assignment-current-item">
                                <span class="admin-report-detail-label">Current Department</span>
                                <strong>{{ $report->department?->name ?? 'Unassigned' }}</strong>
                            </div>
                            <div class="admin-report-assignment-current-item">
                                <span class="admin-report-detail-label">Current Officer</span>
                                <strong>{{ $report->assignedOfficer?->name ?? 'Unassigned' }}</strong>
                            </div>
                        </div>

                        <form action="{{ route('admin.reports.assignment.update', $report) }}" method="POST"
                            class="admin-report-assignment-form">
                            @csrf
                            @method('PATCH')

                            <div class="admin-report-form-group">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="admin-report-form-control"
                                    required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id', $report->assigned_department_id) == $department->id)
                                            @disabled(!$department->is_active && $report->assigned_department_id != $department->id)>
                                            {{ $department->name }}
                                            {{ !$department->is_active ? '(Inactive)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="admin-report-field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="admin-report-form-group">
                                <label for="officer_id">Department Officer</label>
                                <select name="officer_id" id="officer_id" class="admin-report-form-control">
                                    <option value="">Unassigned</option>
                                    @foreach ($officers as $officer)
                                        <option value="{{ $officer->id }}"
                                            data-department="{{ $officer->department_id }}" @selected(old('officer_id', $report->assigned_officer_id) == $officer->id)>
                                            {{ $officer->name }} — {{ $officer->department?->name ?? 'No Department' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('officer_id')
                                    <div class="admin-report-field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="admin-report-form-group">
                                <label for="notes">Assignment Notes <span>(Optional)</span></label>
                                <textarea name="notes" id="notes" rows="4"
                                    class="admin-report-form-control admin-report-form-control--textarea"
                                    placeholder="Optional internal assignment notes...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="admin-report-field-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="admin-report-assignment-submit">
                                <i class="bi bi-arrow-repeat"></i>
                                <span>Update Assignment</span>
                            </button>
                        </form>
                    </div>
                </section>

                <section class="admin-report-card admin-report-activity-card">
                    <div class="admin-report-card__header">
                        <div class="admin-report-card__heading-with-icon">
                            <span class="admin-report-section-icon admin-report-section-icon--activity"><i
                                    class="bi bi-clock-history"></i></span>
                            <div>
                                <span class="admin-report-card__eyebrow">AUDIT TRAIL</span>
                                <h2 class="admin-report-card__title">Activity History</h2>
                            </div>
                        </div>
                    </div>

                    <div class="admin-report-card__body">
                        <div class="admin-report-timeline">
                            @forelse($report->activities->sortByDesc('created_at') as $activity)
                                <article class="admin-report-timeline-item">
                                    <span class="admin-report-timeline-marker"><i class="bi bi-circle-fill"></i></span>
                                    <div class="admin-report-timeline-content">
                                        <strong>{{ ucwords(str_replace('_', ' ', $activity->activity_type->value ?? $activity->activity_type)) }}</strong>
                                        <p>{{ $activity->description }}</p>
                                        <small>
                                            <span>{{ $activity->user?->name ?? 'System' }}</span>
                                            <span class="admin-report-timeline-separator">·</span>
                                            <time>{{ $activity->created_at->format('d M Y, H:i') }}</time>
                                        </small>
                                    </div>
                                </article>
                            @empty
                                <div class="admin-report-empty-state">
                                    <span class="admin-report-empty-state__icon"><i class="bi bi-clock"></i></span>
                                    <strong>No activity recorded</strong>
                                    <span>Updates to this report will appear here.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.getElementById('department_id');
            const officerSelect = document.getElementById('officer_id');

            function filterOfficers() {
                const departmentId = departmentSelect.value;
                const currentOfficer = officerSelect.value;

                Array.from(officerSelect.options).forEach(function(option) {
                    if (!option.value) {
                        option.hidden = false;
                        return;
                    }

                    option.hidden = option.dataset.department !== departmentId;
                });

                const selectedOption = officerSelect.selectedOptions[0];

                if (
                    selectedOption &&
                    selectedOption.value &&
                    selectedOption.dataset.department !== departmentId
                ) {
                    officerSelect.value = '';
                }
            }

            departmentSelect.addEventListener('change', filterOfficers);
            filterOfficers();
        });
    </script>
@endsection
