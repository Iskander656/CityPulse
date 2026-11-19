@extends('layouts.app')

@section('title', 'CityPulse — Administrative Map')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/maps/admin-map.css') }}">
@endpush

@section('content')

    <div class="admin-map-page">

        <div class="admin-map-header">
            <div>
                <span class="admin-map-eyebrow">CITYPULSE / OPERATIONS CENTER</span>
                <h2>City Intelligence Map</h2>
                <p>Real-time overview of active reports across Ashgabat.</p>
            </div>

            <div class="admin-map-counter">
                <span class="counter-indicator"></span>
                <div>
                    <strong>{{ $reports->count() }}</strong>
                    <small>ACTIVE REPORTS</small>
                </div>
            </div>
        </div>

        <div id="admin-city-map"></div>
        <div class="admin-map-legend">
            <span class="legend-title">REPORT STATUS</span>
            <div class="legend-item">
                <span class="legend-dot submitted"></span>
                Submitted
            </div>
            <div class="legend-item">
                <span class="legend-dot under-review"></span>
                Under-Review
            </div>
            <div class="legend-item">
                <span class="legend-dot in-progress"></span>
                In Progress
            </div>
            <div class="legend-item">
                <span class="legend-dot rejected"></span>
                Rejected
            </div>
        </div>

        <script id="admin-map-reports" type="application/json">
            @json($reports)
        </script>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/maps/admin-map.js') }}"></script>
@endpush
