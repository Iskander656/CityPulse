@extends('layouts.app')

@section('title', 'Create Department')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/departments/create.css') }}">
@endpush

@section('content')
    <div class="admin-department-create-page">
        <header class="admin-department-create-header">
            <div class="admin-department-create-header__content">
                <span class="admin-department-create-eyebrow">CITYPULSE / DEPARTMENT DIRECTORY</span>
                <h1 class="admin-department-create-title">Create <span>Department</span></h1>
                <p class="admin-department-create-subtitle">
                    Add a city department and configure its contact information.
                </p>
            </div>

            <a href="{{ route('admin.departments.index') }}" class="admin-department-create-back">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Back to Departments
            </a>
        </header>

        <section class="admin-department-create-card">
            <div class="admin-department-create-card__header">
                <div class="admin-department-create-card__identity">
                    <span class="admin-department-create-icon" aria-hidden="true">
                        <i class="bi bi-building-add"></i>
                    </span>
                    <div>
                        <span class="admin-department-create-card__eyebrow">NEW DEPARTMENT</span>
                        <h2>Department Information</h2>
                        <p>Provide the details for this department.</p>
                    </div>
                </div>
                <span class="admin-department-create-badge">NEW RECORD</span>
            </div>

            <div class="admin-department-create-card__body">
                <form action="{{ route('admin.departments.store') }}" method="POST">
                    @csrf

                    <div class="admin-department-create-field">
                        <label for="department-name" class="form-label">Department Name</label>
                        <input id="department-name" type="text" name="name" class="form-control"
                            value="{{ old('name') }}" placeholder="e.g. Public Works Department" required>
                        @error('name')
                            <div class="admin-department-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-create-field">
                        <label for="department-description" class="form-label">Description</label>
                        <textarea id="department-description" name="description" rows="4" class="form-control"
                            placeholder="Describe the department's responsibilities...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="admin-department-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-create-field">
                        <label for="department-contact-email" class="form-label">Contact Email</label>
                        <input id="department-contact-email" type="email" name="contact_email" class="form-control"
                            value="{{ old('contact_email') }}" placeholder="department@citypulse.gov">
                        @error('contact_email')
                            <div class="admin-department-create-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-create-actions">
                        <a href="{{ route('admin.departments.index') }}" class="admin-department-create-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="admin-department-create-submit">
                            <i class="bi bi-plus-circle" aria-hidden="true"></i>
                            Create Department
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
