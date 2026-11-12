@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card bg-black text-light border-secondary shadow">
                <div class="card-body p-5">

                    <h1 class="fw-bold">Welcome to CityPulse</h1>

                    <p class="text-secondary">
                        Hello, {{ auth()->user()->name }}.
                        You are successfully logged in.
                    </p>

                    <hr class="border-secondary">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Sign Out
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
