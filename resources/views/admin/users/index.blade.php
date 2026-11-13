@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="container-fluid py-4 text-light">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">User Management</h1>
                <p class="text-secondary mb-0">Manage CityPulse accounts and permissions.</p>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-danger">
                + Create User
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card bg-black border-secondary text-light mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3">

                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control bg-dark text-light border-secondary"
                            placeholder="Search name or email..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <select name="role" class="form-select bg-dark text-light border-secondary">
                            <option value="">All Roles</option>
                            @foreach ($users->pluck('role.name')->unique()->filter() as $role)
                                <option value="{{ $role }}" @selected(request('role') === $role)>
                                    {{ ucwords(str_replace('_', ' ', $role)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-outline-light">Filter</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="card bg-black border-secondary text-light">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucwords(str_replace('_', ' ', $user->role?->name ?? 'Unknown')) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->department?->name ?? '—' }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-secondary py-4">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{ $users->links() }}

            </div>
        </div>

    </div>
@endsection
