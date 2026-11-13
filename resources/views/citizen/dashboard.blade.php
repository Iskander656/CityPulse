@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@section('content')
<div class="container py-4 text-light">
    <div class="card bg-black text-light border-secondary shadow mb-4">
        <div class="card-body p-5">
            <h1 class="fw-bold">Citizen Dashboard</h1>
            <p class="text-secondary mb-0">
                Welcome, {{ auth()->user()->name }}. You can submit and track community reports here.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card bg-black text-light border-secondary h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold">My Reports</h4>
                    <p class="text-secondary">
                        View your submitted reports and follow their progress.
                    </p>
                    <a href="{{ route('citizen.reports.index') }}" class="btn btn-outline-light">
                        View My Reports
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-black text-light border-secondary h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold">Submit a Report</h4>
                    <p class="text-secondary">
                        Report a community issue and provide the details needed to address it.
                    </p>
                    <a href="{{ route('citizen.reports.create') }}" class="btn btn-danger">
                        Create New Report
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
