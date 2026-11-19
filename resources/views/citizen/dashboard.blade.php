@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/citizen/dashboard.css') }}">
@endpush

@section('content')
    <div class="citizen-dashboard-page">
        <div class="container citizen-dashboard-container">
            <header class="citizen-dashboard-header">
                <div class="citizen-dashboard-heading">
                    <span class="citizen-dashboard-eyebrow">
                        <span class="citizen-dashboard-live-dot"></span>
                        CITYPULSE / CITIZEN PORTAL
                    </span>
                    <h1>Your city. <span>Your voice.</span></h1>
                    <p>Welcome back, {{ auth()->user()->name }}. Stay connected with your community, report local issues,
                        and follow their progress.</p>
                </div>

                <div class="citizen-dashboard-header-mark" aria-hidden="true">
                    <span>⌖</span>
                    <small>COMMUNITY<br>CONNECTED</small>
                </div>
            </header>

            <section class="citizen-dashboard-section">
                <div class="citizen-dashboard-section-heading">
                    <div>
                        <span class="citizen-dashboard-section-label">YOUR WORKSPACE</span>
                        <h2>How can we help today?</h2>
                        <p>Choose an action to get started.</p>
                    </div>
                    <span class="citizen-dashboard-section-note">CITIZEN SERVICES <span>•</span> CITYPULSE</span>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <article class="citizen-dashboard-action-card citizen-dashboard-action-reports">
                            <div class="citizen-dashboard-card-topline">
                                <span class="citizen-dashboard-action-icon" aria-hidden="true">▤</span>
                                <span class="citizen-dashboard-card-index">01 / TRACK</span>
                            </div>
                            <div class="citizen-dashboard-card-content">
                                <span class="citizen-dashboard-card-kicker">YOUR ACTIVITY</span>
                                <h3>My Reports</h3>
                                <p>Review the issues you've submitted, check their current status, and follow the progress
                                    of your community reports.</p>
                            </div>
                            <a href="{{ route('citizen.reports.index') }}" class="citizen-dashboard-card-link">
                                <span>Explore my reports</span><span class="citizen-dashboard-link-arrow"
                                    aria-hidden="true">→</span>
                            </a>
                        </article>
                    </div>

                    <div class="col-md-6">
                        <article class="citizen-dashboard-action-card citizen-dashboard-action-create">
                            <div class="citizen-dashboard-card-topline">
                                <span class="citizen-dashboard-action-icon" aria-hidden="true">＋</span>
                                <span class="citizen-dashboard-card-index">02 / REPORT</span>
                            </div>
                            <div class="citizen-dashboard-card-content">
                                <span class="citizen-dashboard-card-kicker">MAKE AN IMPACT</span>
                                <h3>Submit a Report</h3>
                                <p>Spotted something that needs attention? Share the details and location so the right city
                                    team can respond.</p>
                            </div>
                            <a href="{{ route('citizen.reports.create') }}" class="citizen-dashboard-card-link">
                                <span>Create a new report</span><span class="citizen-dashboard-link-arrow"
                                    aria-hidden="true">→</span>
                            </a>
                        </article>
                    </div>
                </div>
            </section>

            <section class="citizen-dashboard-impact-strip">
                <div class="citizen-dashboard-impact-icon" aria-hidden="true">✓</div>
                <div class="citizen-dashboard-impact-copy">
                    <strong>Every report makes a difference.</strong>
                    <span>Your local insight helps city teams understand what needs attention.</span>
                </div>
                <span class="citizen-dashboard-impact-mark" aria-hidden="true">CITYPULSE</span>
            </section>

            <footer class="citizen-dashboard-footer">
                <span>YOUR CITY. YOUR VOICE. YOUR IMPACT.</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="citizen-dashboard-logout">Sign out <span
                            aria-hidden="true">↗</span></button>
                </form>
            </footer>
        </div>
    </div>
@endsection
