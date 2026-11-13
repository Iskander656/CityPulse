@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="container py-4 text-light">

        <div class="mb-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm">
                Back to Users
            </a>
        </div>

        <div class="card bg-black text-light border-secondary">
            <div class="card-body p-4">

                <h2 class="mb-4">Create User Account</h2>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    @include('admin.users._form')

                    <button class="btn btn-danger">Create Account</button>
                </form>

            </div>
        </div>

    </div>
@endsection
