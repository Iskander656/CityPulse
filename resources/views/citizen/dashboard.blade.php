@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/citizen/dashboard.css') }}">
@endpush

@section('content')
    <div class="citizen-dashboard-page">
        <div class="container citizen-dashboard-container">
            {{-- Header --}}
            @include('citizen.dashboard.header')
            {{-- Services --}}
            @include('citizen.dashboard.services')
            {{-- Slogan --}}
            @include('citizen.dashboard.slogan')
            {{-- Footer --}}
            @include('citizen.dashboard.footer')
        </div>
    </div>
@endsection
