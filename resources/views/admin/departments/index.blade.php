@extends('layouts.app')
@section('title', 'Department Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/departments/index.css') }}">
@endpush

@section('content')
    <div class="admin-departments-page">
        <div class="admin-departments-header">
            <div>
                <span class="admin-departments-eyebrow">CITYPULSE / ADMINISTRATION</span>
                <h1>Department Management</h1>
                <p>Manage departments, monitor workloads, and control operational status.</p>
            </div>

            <a href="{{ route('admin.departments.create') }}" class="admin-departments-create-btn">
                <span aria-hidden="true">+</span>
                Create Department
            </a>
        </div>

        @if (session('success'))
            <div class="admin-departments-alert" role="alert">
                <span class="admin-departments-alert-icon" aria-hidden="true">✓</span>
                {{ session('success') }}
            </div>
        @endif

        <section class="admin-departments-panel">
            <div class="admin-departments-panel-header">
                <div>
                    <span class="admin-departments-panel-kicker">ORGANIZATION</span>
                    <h2>City Departments</h2>
                    <p>Department directory and operational overview</p>
                </div>
                <div class="admin-departments-panel-indicator">
                    <span></span>
                    Management Registry
                </div>
            </div>

            <div class="admin-departments-table-wrap">
                <table class="admin-departments-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Department</th>
                            <th scope="col">Contact Email</th>
                            <th scope="col">Officers</th>
                            <th scope="col">Reports</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td><span class="admin-departments-id">#{{ $department->id }}</span></td>
                                <td>
                                    <div class="admin-departments-name">{{ $department->name }}</div>
                                    <div class="admin-departments-description">{{ $department->description }}</div>
                                </td>
                                <td>
                                    <span class="admin-departments-email">{{ $department->contact_email ?? '—' }}</span>
                                </td>
                                <td><span class="admin-departments-count">{{ $department->officers_count }}</span></td>
                                <td><span class="admin-departments-count">{{ $department->reports_count }}</span></td>
                                <td>
                                    @if ($department->is_active)
                                        <span class="admin-departments-status is-active"><span></span>Active</span>
                                    @else
                                        <span class="admin-departments-status is-inactive"><span></span>Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="admin-departments-actions">
                                        <a href="{{ route('admin.departments.edit', $department) }}"
                                            class="admin-departments-action-btn edit">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.departments.toggle', $department) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="admin-departments-action-btn {{ $department->is_active ? 'deactivate' : 'activate' }}">
                                                {{ $department->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="admin-departments-empty">
                                    <span class="admin-departments-empty-icon" aria-hidden="true">⌁</span>
                                    <strong>No departments found</strong>
                                    <span>There are currently no departments to display.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="admin-departments-pagination">
                {{ $departments->links() }}
            </div>
        </section>
    </div>
@endsection
