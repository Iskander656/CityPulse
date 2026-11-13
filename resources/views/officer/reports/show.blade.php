@extends('layouts.app')

@section('title', 'Review Report')

@section('content')
    <div class="container py-5">

        <a href="{{ route('officer.reports.index') }}" class="btn btn-outline-secondary mb-4">
            ← Back to Reports
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h3 class="fw-bold">{{ $report->title }}</h3>

                <p class="text-muted">
                    Report #{{ $report->id }} |
                    Submitted {{ $report->created_at->format('d M Y H:i') }}
                </p>

                <hr>

                <p><strong>Citizen:</strong> {{ $report->user->name }}</p>
                <p><strong>Category:</strong> {{ $report->category->name }}</p>
                <p><strong>Status:</strong> {{ $report->status->name }}</p>
                <p><strong>Address:</strong> {{ $report->address ?? 'Not provided' }}</p>

                <h5 class="mt-4">Description</h5>
                <p>{{ $report->description }}</p>

                <h5 class="mt-4">Location</h5>
                <p>
                    Latitude: {{ $report->latitude }}<br>
                    Longitude: {{ $report->longitude }}
                </p>

                @if ($report->images->isNotEmpty())
                    <h5 class="mt-4">Attached Images</h5>

                    <div class="row g-3">
                        @foreach ($report->images as $image)
                            <div class="col-md-4">
                                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded"
                                        alt="Report image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-3">Update Report</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($report->status->is_final)
                    <div class="alert alert-info mb-0">
                        This report is closed and cannot be updated.
                    </div>
                @else
                    <form method="POST" action="{{ route('officer.reports.update', $report) }}">

                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">New Status</label>

                            <select name="status_id" class="form-select" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id', $report->status_id) == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Update Notes</label>

                            <textarea name="notes" class="form-control" rows="4" maxlength="1000"
                                placeholder="Describe the progress or action taken...">{{ old('notes') }}</textarea>

                            <small class="text-muted">
                                These updates are also visible in the citizen's activity timeline.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-dark">
                            Save Update
                        </button>

                    </form>
                @endif

            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">Activity History</h4>

                @forelse ($report->activities->sortByDesc('created_at') as $activity)
                    <div class="border-start border-3 ps-3 mb-4">
                        <strong>
                            {{ str($activity->activity_type->value)->replace('_', ' ')->title() }}
                        </strong>

                        <p class="mb-1">{{ $activity->description }}</p>

                        <small class="text-muted">
                            {{ $activity->user->name ?? 'System' }}
                            ·
                            {{ $activity->created_at->format('d M Y H:i') }}
                        </small>
                    </div>
                @empty
                    <p class="text-muted">No activity recorded.</p>
                @endforelse

            </div>
        </div>

    </div>
@endsection
