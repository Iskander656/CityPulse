@extends('layouts.app')
@section('title', 'Department Management')
@section('content')

    <div class="container-fluid py-4 text-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">Department Management</h1>
                <p class="text-secondary mb-0">Manage CityPulse departments.</p>
            </div>

            <a href="{{ route('admin.departments.create') }}" class="btn btn-danger">
                + Create Department
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card bg-black border-secondary text-light">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department</th>
                                <th>Contact Email</th>
                                <th>Officers</th>
                                <th>Reports</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>
                                        <strong>{{ $department->name }}</strong>
                                        <div class="small text-secondary">
                                            {{ $department->description }}
                                        </div>
                                    </td>
                                    <td>{{ $department->contact_email ?? '—' }}</td>
                                    <td>{{ $department->officers_count }}</td>
                                    <td>{{ $department->reports_count }}</td>
                                    <td>
                                        @if ($department->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.departments.edit', $department) }}"
                                                class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.departments.toggle', $department) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    class="btn btn-sm {{ $department->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                    {{ $department->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary py-4">
                                        No departments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $departments->links() }}

            </div>
        </div>
    </div>
@endsection
