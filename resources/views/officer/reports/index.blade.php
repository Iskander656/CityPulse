@extends('layouts.app')

@section('title', 'Department Reports')

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
            <h2 class="fw-bold mb-0">Department Reports</h2>

            <a href="{{ route('officer.dashboard') }}" class="btn btn-outline-light">
                ← Back to Dashboard
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                @if ($reports->isEmpty())
                    <div class="text-center py-5">
                        <h5>No reports available</h5>
                        <p class="text-muted">Your department has no assigned reports.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Report</th>
                                    <th>Category</th>
                                    <th>Citizen</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->title }}</td>
                                        <td>{{ $report->category->name }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $report->status->name }}
                                            </span>
                                        </td>
                                        <td>{{ $report->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('officer.reports.show', $report) }}"
                                                class="btn btn-sm btn-danger">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $reports->links() }}
                @endif

            </div>
        </div>

    </div>
@endsection
