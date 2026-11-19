@extends('layouts.app')

@section('title', 'CityPulse — Administrative Map')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/maps/admin-map.css') }}">
@endpush

@section('content')
    <div class="admin-map-page">
        <header class="admin-map-header">
            <div class="admin-map-heading">
                <span class="admin-map-eyebrow">CITYPULSE / OPERATIONS CENTER</span>
                <h1>City Intelligence Map</h1>
                <p>Monitor reported incidents and their locations across Ashgabat.</p>
            </div>

            <div class="admin-map-counter" aria-label="{{ $reports->count() }} active reports">
                <span class="counter-indicator" aria-hidden="true"></span>
                <div class="admin-map-counter-content">
                    <strong>{{ $reports->count() }}</strong>
                    <small>ACTIVE REPORTS</small>
                </div>
            </div>
        </header>

        <section class="admin-map-workspace" aria-label="City reports map">
            <div class="admin-map-workspace-header">
                <div>
                    <span class="admin-map-section-kicker">LIVE OVERVIEW</span>
                    <h2>Incident Locations</h2>
                </div>
                <span class="admin-map-live-status">
                    <span aria-hidden="true"></span>
                    Map View
                </span>
            </div>

            <div class="admin-map-canvas-wrap">
                <div id="admin-city-map"></div>
            </div>

            <div class="admin-map-legend">
                <div class="admin-map-legend-heading">
                    <span class="legend-title">REPORT STATUS</span>
                    <small>Marker color guide</small>
                </div>
                <div class="admin-map-legend-items">
                    <div class="legend-item">
                        <span class="legend-dot submitted"></span>
                        Submitted
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot under-review"></span>
                        Under Review
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
            </div>
        </section>

        <script id="admin-map-reports" type="application/json">
            @json($reports)
        </script>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/maps/admin-map.js') }}"></script>
@endpush
