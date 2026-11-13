@extends('layouts.app')

@section('title', 'My Reports')

@section('content')

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">My Reports</h2>

            <a href="{{ route('citizen.dashboard') }}" class="btn btn-outline-light">
                ← Back to Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card bg-dark border-secondary">

            <div class="card-body">

                @forelse($reports as $report)
                    <div class="border-bottom border-secondary py-3">

                        <h5 class="text-light">
                            {{ $report->title }}
                        </h5>

                        <p class="text-secondary mb-1">
                            {{ $report->category->name }}
                        </p>

                        <span class="badge bg-info">
                            {{ $report->status->name }}
                        </span>

                        <a href="{{ route('citizen.reports.show', $report) }}"
                            class="btn btn-sm btn-outline-light float-end">
                            View Details
                        </a>

                    </div>

                @empty

                    <p class="text-secondary">
                        You haven't submitted any reports yet.
                    </p>
                @endforelse

                {{ $reports->links() }}

            </div>

        </div>

    </div>

@endsection
