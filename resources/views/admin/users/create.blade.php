@extends('layouts.app')

@section('title', 'Create User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users/user-create.css') }}">
@endpush

@section('content')
    <div class="admin-user-form-page">
        <header class="admin-user-form-header">
            <div class="admin-user-form-header__content">
                <span class="admin-user-form-eyebrow">CITYPULSE / USER DIRECTORY</span>
                <h1 class="admin-user-form-header__title">Create <span>User</span></h1>
                <p class="admin-user-form-header__subtitle">
                    Add a new account and configure its access settings.
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
                        <i class="bi bi-person-plus" aria-hidden="true"></i>
                    </span>
                    <div>
                        <span class="admin-user-form-card__eyebrow">NEW ACCOUNT</span>
                        <h2>Create User Account</h2>
                        <p>Enter the account details below.</p>
                    </div>
                </div>
                <span class="admin-user-form-id">NEW USER</span>
            </div>

            <div class="admin-user-form-card__body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    @include('admin.users._form')

                    <div class="admin-user-form-actions">
                        <a href="{{ route('admin.users.index') }}" class="admin-user-form-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="admin-user-form-submit">
                            <i class="bi bi-person-check" aria-hidden="true"></i>
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
