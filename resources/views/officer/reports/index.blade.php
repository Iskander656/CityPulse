@extends('layouts.app')

@section('title', 'Department Reports')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/officer/reports/index.css') }}">
    @endpush

    <div class="officer-reports-page">
        <div class="officer-reports-container">
            <header class="officer-reports-header">
                <div>
                    <div class="officer-reports-eyebrow"><span></span> CITYPULSE / DEPARTMENT OPERATIONS</div>
                    <h1>Department Reports</h1>
                    <p>Review and monitor reports assigned to your department.</p>
                </div>

                <a href="{{ route('officer.dashboard') }}" class="officer-reports-back">
                    <span aria-hidden="true">←</span> Back to Dashboard
                </a>
            </header>

            <section class="officer-reports-panel">
                <div class="officer-reports-panel-heading">
                    <div>
                        <span class="officer-reports-kicker">REPORT REGISTER</span>
                        <h2>Assigned reports</h2>
                        <p>All reports currently available to your department.</p>
                    </div>
                    <div class="officer-reports-count">{{ $reports->total() }} <span>REPORTS</span></div>
                </div>

                @if ($reports->isEmpty())
                    <div class="officer-reports-empty">
                        <div class="officer-reports-empty-icon">⌕</div>
                        <h3>No reports available</h3>
                        <p>Your department has no assigned reports at the moment.</p>
                    </div>
                @else
                    <div class="table-responsive officer-reports-table-wrap">
                        <table class="table officer-reports-table align-middle">
                            <thead>
                                <tr>
                                    <th>REPORT</th>
                                    <th>CATEGORY</th>
                                    <th>CITIZEN</th>
                                    <th>STATUS</th>
                                    <th>DATE SUBMITTED</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>
                                            <span class="officer-reports-title">{{ $report->title }}</span>
                                            <span class="officer-reports-id">REPORT #{{ $report->id }}</span>
                                        </td>
                                        <td>{{ $report->category->name }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td>
                                            <span class="officer-reports-status">{{ $report->status->name }}</span>
                                        </td>
                                        <td>{{ $report->created_at->format('d M Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('officer.reports.show', $report) }}"
                                                class="officer-reports-review">
                                                Review <span aria-hidden="true">→</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="officer-reports-pagination">
                        {{ $reports->links() }}
                    </div>
                @endif
            </section>

            <footer class="officer-reports-footer">CITYPULSE <span>•</span> DEPARTMENT OPERATIONS</footer>
        </div>
    </div>
@endsection
