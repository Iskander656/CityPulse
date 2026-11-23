@extends('layouts.app')

@section('title', 'Officer Command Center')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/officer/dashboard.css') }}">
    @endpush

    <div class="officer-dashboard-page">
        <div class="container-fluid officer-dashboard-container">
            {{-- Header --}}
            @include('officer.dashboard.header')
            {{-- Performance profile --}}
            @include('officer.dashboard.performance')
            {{-- Recent Activities --}}
            @include('officer.dashboard.recent_activity')

            <footer class="officer-dashboard-footer">CITYPULSE <span>•</span> DEPARTMENT OPERATIONS</footer>
        </div>
    </div>
@endsection
