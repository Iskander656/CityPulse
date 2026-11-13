@extends('layouts.app')
@section('title', 'Create Department')
@section('content')
    <div class="container py-4 text-light">
        <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-light btn-sm mb-4">
            Back to Departments
        </a>

        <div class="card bg-black border-secondary text-light">
            <div class="card-body p-4">

                <h2 class="mb-4">Create Department</h2>

                <form action="{{ route('admin.departments.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-light border-secondary"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control bg-dark text-light border-secondary">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control bg-dark text-light border-secondary"
                            value="{{ old('contact_email') }}">
                        @error('contact_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-danger">Create Department</button>
                </form>

            </div>
        </div>
    </div>
@endsection
