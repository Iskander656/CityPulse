
@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@section('content')
<div class="cp-citizen-dashboard">
    <div class="container cp-shell">
        <section class="cp-hero mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                    <span class="cp-eyebrow"><span class="cp-live-dot"></span> CityPulse / Citizen Portal</span>
                    <h1>Your city.<br class="d-sm-none"> Your voice.</h1>
                    <p>Welcome back, {{ auth()->user()->name }}. Help make your community better by reporting local issues and keeping track of their progress.</p>
                </div>
                <div class="cp-hero-mark" aria-hidden="true">⌖</div>
            </div>
        </section>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="cp-section-label">Citizen workspace</div>
                <h2 class="h4 fw-bold mt-2 mb-0">What would you like to do?</h2>
            </div>
            <span class="small text-secondary d-none d-sm-inline">YOUR COMMUNITY STARTS HERE</span>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <article class="cp-action-card">
                    <div class="cp-action-icon cp-icon-blue" aria-hidden="true">▤</div>
                    <h2>My Reports</h2>
                    <p>Review the issues you've submitted, check their current status, and follow the progress of your community reports.</p>
                    <a href="{{ route('citizen.reports.index') }}" class="cp-card-link">Explore my reports <span aria-hidden="true">→</span></a>
                </article>
            </div>
            <div class="col-md-6">
                <article class="cp-action-card">
                    <div class="cp-action-icon cp-icon-red" aria-hidden="true">＋</div>
                    <h2>Submit a Report</h2>
                    <p>Spotted something that needs attention? Send a report with the details and location so the right team can respond.</p>
                    <a href="{{ route('citizen.reports.create') }}" class="cp-card-link">Create a new report <span aria-hidden="true">→</span></a>
                </article>
            </div>
        </div>

        <div class="cp-info-strip mt-4">
            <div class="cp-info-icon" aria-hidden="true">✓</div>
            <div>
                <strong>Every report makes a difference</strong>
                <span>Your local insight helps city teams understand what needs attention.</span>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn cp-logout">Sign out <span aria-hidden="true">↗</span></button>
            </form>
        </div>
    </div>
</div>
@endsection
