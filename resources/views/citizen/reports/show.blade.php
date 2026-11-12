@extends('layouts.app')

@section('title', 'Report Details')

@section('content')

    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="text-light">Report Details</h2>
                <p class="text-secondary mb-0">
                    Report #{{ $report->id }}
                </p>
            </div>

            <a href="{{ route('citizen.reports.index') }}" class="btn btn-outline-light">
                Back to My Reports
            </a>

        </div>

        {{-- Report Information --}}
        <div class="card bg-dark text-light border-secondary mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <h3>{{ $report->title }}</h3>

                        <p class="text-secondary">
                            {{ $report->category->name }}
                        </p>
                    </div>

                    <span class="badge bg-info fs-6">
                        {{ $report->status->name }}
                    </span>

                </div>

                <hr class="border-secondary">

                <h5>Description</h5>

                <p class="text-light">
                    {{ $report->description }}
                </p>

                <hr class="border-secondary">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <small class="text-secondary">Submitted</small>
                        <p>{{ $report->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-secondary">Last Updated</small>
                        <p>{{ $report->updated_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="col-md-12">
                        <small class="text-secondary">Address</small>

                        <p>
                            {{ $report->address ?? 'No address provided' }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <small class="text-secondary">Latitude</small>
                        <p>{{ $report->latitude }}</p>
                    </div>

                    <div class="col-md-6">
                        <small class="text-secondary">Longitude</small>
                        <p>{{ $report->longitude }}</p>
                    </div>

                </div>

            </div>

        </div>

        {{-- Images --}}
        <div class="card bg-dark text-light border-secondary mb-4">

            <div class="card-body p-4">

                <h4 class="mb-3">Attachments</h4>

                @forelse($report->images as $image)
                    <div class="mb-3">

                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Report attachment"
                            class="img-fluid rounded" style="max-height: 300px;">

                        <p class="text-secondary mt-2">
                            {{ $image->original_name }}
                        </p>

                    </div>

                @empty

                    <p class="text-secondary">
                        No images attached to this report.
                    </p>
                @endforelse

            </div>

        </div>

        {{-- Activity Timeline --}}
        <div class="card bg-dark text-light border-secondary">

            <div class="card-body p-4">

                <h4 class="mb-4">Report Activity</h4>

                @forelse($report->activities as $activity)

                    <div class="border-start border-secondary ps-3 mb-4">

                        <h6 class="text-info">
                            {{ str($activity->activity_type->value)->replace('_', ' ')->title() }}
                        </h6>

                        <p class="mb-1">
                            {{ $activity->description }}
                        </p>

                        <small class="text-secondary">

                            {{ $activity->created_at->format('d M Y, H:i') }}

                            @if ($activity->user)
                                · {{ $activity->user->name }}
                            @endif

                        </small>

                        @if ($activity->oldStatus || $activity->newStatus)
                            <p class="mt-2 small">

                                @if ($activity->oldStatus)
                                    {{ $activity->oldStatus->name }}
                                @endif

                                @if ($activity->oldStatus && $activity->newStatus)
                                    →
                                @endif

                                @if ($activity->newStatus)
                                    {{ $activity->newStatus->name }}
                                @endif

                            </p>
                        @endif

                    </div>

                @empty

                    <p class="text-secondary">
                        No activity recorded yet.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

@endsection
