@extends('layouts.app')

@section('title', 'CityPulse Command Centre')

@section('content')

    <div class="command-centre">

        {{-- Header --}}
        @include('admin.dashboard.partials.header')

        {{-- Platform Metrics --}}
        @include('admin.dashboard.partials.metrics')

        {{-- Circular Analytics --}}
        <div class="row g-4 mb-4">

            <div class="col-12 col-xl-5">
                @include('admin.dashboard.partials.resolution-ring')
            </div>

            <div class="col-12 col-xl-7">
                @include('admin.dashboard.partials.status-rings')
            </div>

        </div>

        {{-- Department Performance --}}
        @include('admin.dashboard.partials.departments')

        @include('admin.dashboard.partials.charts')

        {{-- Category Analytics and Recent Reports --}}
        <div class="row g-4 mb-4">

            <div class="col-12 col-xl-4">
                @include('admin.dashboard.partials.categories')
            </div>

            <div class="col-12 col-xl-8">
                @include('admin.dashboard.partials.recent-reports')
            </div>

        </div>

        {{-- Administration --}}
        @include('admin.dashboard.partials.navigation')

    </div>

@endsection
