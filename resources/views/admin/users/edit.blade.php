@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container py-4 text-light">

        <div class="mb-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm">
                Back to Users
            </a>
        </div>

        <div class="card bg-black text-light border-secondary">
            <div class="card-body p-4">

                <h2 class="mb-4">Edit User: {{ $user->name }}</h2>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.users._form')

                    <button class="btn btn-danger">Save Changes</button>
                </form>

            </div>
        </div>

    </div>
@endsection
