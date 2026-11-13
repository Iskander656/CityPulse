@extends('layouts.app')

@section('title', 'Report Details')

@section('content')
    <div class="container py-4 text-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold">Report #{{ $report->id }}</h1>
                <p class="text-secondary mb-0">
                    Complete report information and assignment management.
                </p>
            </div>

            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-light">
                Back to Reports
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">

            <div class="col-lg-7">

                <div class="card bg-black border-secondary text-light mb-4">
                    <div class="card-body p-4">

                        <h3>{{ $report->title }}</h3>

                        <hr class="border-secondary">

                        <p class="text-secondary mb-1">Description</p>
                        <p>{{ $report->description }}</p>

                        <p class="text-secondary mb-1">Category</p>
                        <p>{{ $report->category->name }}</p>

                        <p class="text-secondary mb-1">Citizen</p>
                        <p>{{ $report->user->name }}</p>

                        <p class="text-secondary mb-1">Address</p>
                        <p>{{ $report->address ?? 'Not provided' }}</p>

                        <p class="text-secondary mb-1">Coordinates</p>
                        <p>
                            {{ $report->latitude }},
                            {{ $report->longitude }}
                        </p>

                        <p class="text-secondary mb-1">Current Status</p>
                        <span class="badge bg-secondary">
                            {{ $report->status->name }}
                        </span>

                    </div>
                </div>

                <div class="card bg-black border-secondary text-light mb-4">

                    <div class="card-header border-secondary">
                        <h5 class="mb-0">Report Images</h5>
                    </div>

                    <div class="card-body">

                        @forelse($report->images as $image)
                            <div class="mb-3">
                                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded"
                                        style="max-height: 300px;" alt="Report image">
                                </a>
                            </div>

                        @empty

                            <p class="text-secondary mb-0">
                                No images attached.
                            </p>
                        @endforelse

                    </div>
                </div>

            </div>

            <div class="col-lg-5">

                <div class="card bg-black border-secondary text-light mb-4">

                    <div class="card-header border-secondary py-3">
                        <h5 class="mb-0">Assignment Management</h5>
                    </div>

                    <div class="card-body">

                        <p>
                            <span class="text-secondary">Current Department:</span>
                            {{ $report->department?->name ?? 'Unassigned' }}
                        </p>

                        <p>
                            <span class="text-secondary">Current Officer:</span>
                            {{ $report->assignedOfficer?->name ?? 'Unassigned' }}
                        </p>

                        <hr class="border-secondary">

                        <form action="{{ route('admin.reports.assignment.update', $report) }}" method="POST">

                            @csrf
                            @method('PATCH')

                            <div class="mb-3">

                                <label class="form-label">Department</label>

                                <select name="department_id" id="department_id"
                                    class="form-select bg-dark text-light border-secondary" required>

                                    <option value="">Select Department</option>

                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id', $report->assigned_department_id) == $department->id)
                                            @disabled(!$department->is_active && $report->assigned_department_id != $department->id)>

                                            {{ $department->name }}
                                            {{ !$department->is_active ? '(Inactive)' : '' }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('department_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">Department Officer</label>

                                <select name="officer_id" id="officer_id"
                                    class="form-select bg-dark text-light border-secondary">

                                    <option value="">Unassigned</option>

                                    @foreach ($officers as $officer)
                                        <option value="{{ $officer->id }}"
                                            data-department="{{ $officer->department_id }}" @selected(old('officer_id', $report->assigned_officer_id) == $officer->id)>

                                            {{ $officer->name }}
                                            — {{ $officer->department?->name ?? 'No Department' }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('officer_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">Assignment Notes</label>

                                <textarea name="notes" rows="3" class="form-control bg-dark text-light border-secondary"
                                    placeholder="Optional internal assignment notes...">{{ old('notes') }}</textarea>

                                @error('notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <button class="btn btn-danger w-100">
                                Update Assignment
                            </button>

                        </form>

                    </div>
                </div>

                <div class="card bg-black border-secondary text-light">

                    <div class="card-header border-secondary py-3">
                        <h5 class="mb-0">Activity History</h5>
                    </div>

                    <div class="card-body">

                        @forelse($report->activities->sortByDesc('created_at') as $activity)
                            <div class="border-start border-secondary ps-3 mb-4">

                                <strong>
                                    {{ ucwords(str_replace('_', ' ', $activity->activity_type->value ?? $activity->activity_type)) }}
                                </strong>

                                <p class="mb-1">
                                    {{ $activity->description }}
                                </p>

                                <small class="text-secondary">
                                    {{ $activity->user?->name ?? 'System' }}
                                    ·
                                    {{ $activity->created_at->format('d M Y, H:i') }}
                                </small>

                            </div>

                        @empty

                            <p class="text-secondary">
                                No activity recorded.
                            </p>
                        @endforelse

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const departmentSelect = document.getElementById('department_id');
            const officerSelect = document.getElementById('officer_id');

            function filterOfficers() {

                const departmentId = departmentSelect.value;
                const currentOfficer = officerSelect.value;

                Array.from(officerSelect.options).forEach(function(option) {

                    if (!option.value) {
                        option.hidden = false;
                        return;
                    }

                    option.hidden = option.dataset.department !== departmentId;

                });

                const selectedOption = officerSelect.selectedOptions[0];

                if (
                    selectedOption &&
                    selectedOption.value &&
                    selectedOption.dataset.department !== departmentId
                ) {
                    officerSelect.value = '';
                }
            }

            departmentSelect.addEventListener('change', filterOfficers);

            filterOfficers();

        });
    </script>
@endsection
