@extends('layouts.app')

@section('title', 'Edit User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users/user-form.css') }}">
@endpush

@section('content')
    <div class="admin-user-form-page">
        <header class="admin-user-form-header">
            <div class="admin-user-form-header__content">
                <span class="admin-user-form-eyebrow">CITYPULSE / USER DIRECTORY</span>
                <h1 class="admin-user-form-header__title">Edit <span>User</span></h1>
                <p class="admin-user-form-header__subtitle">
                    Update account information and access settings for {{ $user->name }}.
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}" class="admin-user-form-back">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Back to Users
            </a>
        </header>

        <section class="admin-user-form-card">
            <div class="admin-user-form-card__header">
                <div class="admin-user-form-card__identity">
                    <span class="admin-user-form-avatar" aria-hidden="true">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    <div>
                        <span class="admin-user-form-card__eyebrow">ACCOUNT SETTINGS</span>
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                <span class="admin-user-form-id">USER #{{ $user->id }}</span>
            </div>

            <div class="admin-user-form-card__body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.users._form')

                    <div class="admin-user-form-actions">
                        <a href="{{ route('admin.users.index') }}" class="admin-user-form-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="admin-user-form-submit">
                            <i class="bi bi-check2-circle" aria-hidden="true"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
