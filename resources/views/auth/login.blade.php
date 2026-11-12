@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card bg-black text-light border-secondary shadow">

                <div class="card-body p-4">

                    <h2 class="text-center fw-bold mb-2">Welcome Back</h2>

                    <p class="text-secondary text-center mb-4">
                        Sign in to your CityPulse account.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">

                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Sign In
                        </button>

                    </form>

                    <p class="text-center mt-4 mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}">Register</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

@endsection
