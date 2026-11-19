@extends('layouts.app')

@section('title', 'CityPulse — Create Account')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endpush

@section('content')
    <div class="auth-register-page">
        <div class="auth-register-shell">
            <section class="auth-register-intro">
                <span class="auth-register-eyebrow">CITYPULSE / COMMUNITY NETWORK</span>
                <div class="auth-register-brand-mark" aria-hidden="true">C</div>
                <h1>Make your city better.</h1>
                <p>Create your CityPulse account to report local issues, follow updates, and take part in building a better community.</p>
                <div class="auth-register-intro-footer">
                    <span class="auth-register-status-dot"></span>
                    YOUR CITY. YOUR VOICE. YOUR IMPACT.
                </div>
            </section>

            <section class="auth-register-card">
                <div class="auth-register-card-heading">
                    <span class="auth-register-section-label">GET STARTED</span>
                    <h2>Create account</h2>
                    <p>Fill in your details to join CityPulse.</p>
                </div>

                @if ($errors->any())
                    <div class="auth-register-errors" role="alert">
                        <strong>Please check the information below.</strong>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="auth-register-form">
                    @csrf

                    <div class="auth-register-field">
                        <label for="name">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            required
                        >
                    </div>

                    <div class="auth-register-field">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="auth-register-field">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Create a password"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    <div class="auth-register-field">
                        <label for="password_confirmation">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Enter your password again"
                            autocomplete="new-password"
                            required
                        >
                    </div>

                    <button type="submit" class="auth-register-submit">
                        Create Account
                        <span aria-hidden="true">→</span>
                    </button>
                </form>

                <div class="auth-register-login">
                    <span>Already registered?</span>
                    <a href="{{ route('login') }}">Sign in</a>
                </div>

                <div class="auth-register-card-footer">
                    <span>SECURE REGISTRATION</span>
                    <span>POWERED BY CITYPULSE</span>
                </div>
            </section>
        </div>
    </div>
@endsection
