@extends('layouts.app')

@section('title', 'Edit Department')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/departments/edit.css') }}">
@endpush

@section('content')
    <div class="admin-department-edit-page">
        <header class="admin-department-edit-header">
            <div class="admin-department-edit-header__content">
                <span class="admin-department-edit-eyebrow">CITYPULSE / DEPARTMENT DIRECTORY</span>
                <h1 class="admin-department-edit-title">Edit <span>Department</span></h1>
                <p class="admin-department-edit-subtitle">
                    Update the department's information and contact details.
                </p>
            </div>

            <a href="{{ route('admin.departments.index') }}" class="admin-department-edit-back">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Back to Departments
            </a>
        </header>

        <section class="admin-department-edit-card">
            <div class="admin-department-edit-card__header">
                <div class="admin-department-edit-card__identity">
                    <span class="admin-department-edit-icon" aria-hidden="true">
                        <i class="bi bi-building-gear"></i>
                    </span>
                    <div>
                        <span class="admin-department-edit-card__eyebrow">DEPARTMENT SETTINGS</span>
                        <h2>{{ $department->name }}</h2>
                        <p>Modify this department's directory information.</p>
                    </div>
                </div>
                <span class="admin-department-edit-badge">DEPT #{{ $department->id }}</span>
            </div>

            <div class="admin-department-edit-card__body">
                <form action="{{ route('admin.departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="admin-department-edit-field">
                        <label for="department-name" class="form-label">Department Name</label>
                        <input id="department-name" type="text" name="name" class="form-control"
                            value="{{ old('name', $department->name) }}" required>
                        @error('name')
                            <div class="admin-department-edit-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-edit-field">
                        <label for="department-description" class="form-label">Description</label>
                        <textarea id="department-description" name="description" rows="4" class="form-control">{{ old('description', $department->description) }}</textarea>
                        @error('description')
                            <div class="admin-department-edit-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-edit-field">
                        <label for="department-contact-email" class="form-label">Contact Email</label>
                        <input id="department-contact-email" type="email" name="contact_email" class="form-control"
                            value="{{ old('contact_email', $department->contact_email) }}">
                        @error('contact_email')
                            <div class="admin-department-edit-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-department-edit-actions">
                        <a href="{{ route('admin.departments.index') }}" class="admin-department-edit-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="admin-department-edit-submit">
                            <i class="bi bi-check2-circle" aria-hidden="true"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
