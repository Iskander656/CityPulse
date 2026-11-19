
@extends('layouts.app')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/users/users.css') }}">
@endpush

@section('content')
    <div class="admin-users-page">
        <header class="admin-users-header">
            <div class="admin-users-header__content">
                <span class="admin-users-eyebrow">CITYPULSE / ADMINISTRATION</span>
                <h1 class="admin-users-header__title">User <span>Management</span></h1>
                <p class="admin-users-header__subtitle">Manage CityPulse accounts, roles, and department access.</p>
            </div>

            <a href="{{ route('admin.users.create') }}" class="admin-users-create-button">
                <i class="bi bi-person-plus-fill" aria-hidden="true"></i>
                <span>Create User</span>
            </a>
        </header>

        @if (session('success'))
            <div class="admin-users-alert" role="status">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <section class="admin-users-filter-card" aria-label="Filter users">
            <div class="admin-users-section-heading">
                <div class="admin-users-section-icon">
                    <i class="bi bi-funnel-fill" aria-hidden="true"></i>
                </div>
                <div>
                    <h2>Find users</h2>
                    <p>Search accounts or narrow the list by role.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.users.index') }}" class="admin-users-filter-form">
                <div class="admin-users-filter-field admin-users-search-field">
                    <label for="users-search">Search accounts</label>
                    <div class="admin-users-input-wrap">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <input
                            id="users-search"
                            type="text"
                            name="search"
                            class="admin-users-form-control"
                            placeholder="Search name or email..."
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>

                <div class="admin-users-filter-field">
                    <label for="users-role">Account role</label>
                    <select id="users-role" name="role" class="admin-users-form-control">
                        <option value="">All Roles</option>
                        @foreach ($users->pluck('role.name')->unique()->filter() as $role)
                            <option value="{{ $role }}" @selected(request('role') === $role)>
                                {{ ucwords(str_replace('_', ' ', $role)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-users-filter-actions">
                    <button type="submit" class="admin-users-filter-button">
                        <i class="bi bi-sliders" aria-hidden="true"></i>
                        Apply filters
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="admin-users-reset-button" aria-label="Clear filters">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </section>

        <section class="admin-users-table-card">
            <div class="admin-users-table-header">
                <div class="admin-users-section-heading">
                    <div class="admin-users-section-icon admin-users-section-icon--users">
                        <i class="bi bi-people-fill" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h2>Registered accounts</h2>
                        <p>Review account details and manage user access.</p>
                    </div>
                </div>
                <span class="admin-users-table-label">
                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                    User directory
                </span>
            </div>

            <div class="admin-users-table-wrapper">
                <table class="admin-users-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Email address</th>
                            <th scope="col">Role</th>
                            <th scope="col">Department</th>
                            <th scope="col">Registered</th>
                            <th scope="col" class="admin-users-action-heading">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td><span class="admin-users-id">#{{ $user->id }}</span></td>
                                <td>
                                    <div class="admin-users-person">
                                        <span class="admin-users-avatar" aria-hidden="true">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                        <span class="admin-users-person-name">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td><span class="admin-users-email">{{ $user->email }}</span></td>
                                <td>
                                    <span class="admin-users-role-badge">
                                        <span class="admin-users-role-dot"></span>
                                        {{ ucwords(str_replace('_', ' ', $user->role?->name ?? 'Unknown')) }}
                                    </span>
                                </td>
                                <td><span class="admin-users-department">{{ $user->department?->name ?? '—' }}</span></td>
                                <td><span class="admin-users-date">{{ $user->created_at->format('d M Y') }}</span></td>
                                <td class="admin-users-action-cell">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="admin-users-edit-button">
                                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="admin-users-empty-state">
                                        <span class="admin-users-empty-icon"><i class="bi bi-person-x" aria-hidden="true"></i></span>
                                        <strong>No users found</strong>
                                        <span>Try changing your search or role filters.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="admin-users-pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </section>
    </div>
@endsection
