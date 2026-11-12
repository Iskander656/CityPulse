@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@section('content')
    <div class="card bg-black text-light border-secondary">
        <div class="card-body p-5">
            <h1>Citizen Dashboard</h1>
            <p>Welcome, {{ auth()->user()->name }}.</p>
            <p>You can submit and track community reports.</p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection
