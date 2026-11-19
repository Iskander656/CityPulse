@extends('layouts.app')

@section('title', 'CityPulse — Sign In')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush

@section('content')
    <div class="auth-login-page">
        <div class="auth-login-shell">
            <section class="auth-login-intro">
                <span class="auth-login-eyebrow">CITYPULSE / CITY INTELLIGENCE</span>
                <div class="auth-login-brand-mark" aria-hidden="true">C</div>
                <h1>Welcome back.</h1>
                <p>Sign in to access your CityPulse workspace and stay connected with your city's progress.</p>
                <div class="auth-login-intro-footer">
                    <span class="auth-login-status-dot"></span>
                    CITY SERVICES • CONNECTED
                </div>
            </section>

            <section class="auth-login-card">
                <div class="auth-login-card-heading">
                    <span class="auth-login-section-label">ACCOUNT ACCESS</span>
                    <h2>Sign in</h2>
                    <p>Enter your account details to continue.</p>
                </div>

                @if ($errors->any())
                    <div class="auth-login-errors" role="alert">
                        <strong>We couldn't sign you in.</strong>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="auth-login-form">
                    @csrf

                    <div class="auth-login-field">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="name@example.com" autocomplete="email" required>
                    </div>

                    <div class="auth-login-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                            autocomplete="current-password" required>
                    </div>

                    <label class="auth-login-remember" for="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember me</span>
                    </label>

                    <button type="submit" class="auth-login-submit">
                        Sign In
                        <span aria-hidden="true">→</span>
                    </button>
                </form>

                <div class="auth-login-register">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}">Create an account</a>
                </div>

                <div class="auth-login-card-footer">
                    <span>SECURE ACCESS</span>
                    <span>POWERED BY CITYPULSE</span>
                </div>
            </section>
        </div>
    </div>
@endsection
