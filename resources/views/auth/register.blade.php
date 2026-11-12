@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card bg-black text-light border-secondary shadow">

                <div class="card-body p-4">

                    <h2 class="text-center fw-bold mb-2">Create Account</h2>

                    <p class="text-secondary text-center mb-4">
                        Join your community with CityPulse.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Create Account
                        </button>

                    </form>

                    <p class="text-center mt-4 mb-0">
                        Already registered?
                        <a href="{{ route('login') }}">Sign in</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

@endsection
