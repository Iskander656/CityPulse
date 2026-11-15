<div class="cc-panel">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <div class="cc-label">Latest Activity</div>
            <h5 class="fw-bold mt-2 mb-0">Recent Reports</h5>
        </div>

        <a href="{{ route('admin.reports.index') }}" class="btn btn-danger cc-btn btn-sm">
            View All →
        </a>

    </div>

    <div class="table-responsive">

        <table class="table cc-table">

            <thead>
                <tr>
                    <th>Report</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($recentReports as $report)
                    <tr>

                        <td>
                            <div class="fw-semibold">
                                #{{ $report->id }}
                            </div>

                            <div class="small cc-muted">
                                {{ \Illuminate\Support\Str::limit($report->title, 35) }}
                            </div>
                        </td>

                        <td class="small">
                            {{ $report->department?->name ?? 'Unassigned' }}
                        </td>

                        <td>

                            @php
                                $statusColors = [
                                    'submitted' => 'warning',
                                    'under-review' => 'info',
                                    'assigned' => 'primary',
                                    'in-progress' => 'primary',
                                    'resolved' => 'success',
                                    'rejected' => 'danger',
                                ];

                                $badgeColor = $statusColors[$report->status->slug] ?? 'secondary';
                            @endphp

                            <span class="badge bg-{{ $badgeColor }}">
                                {{ $report->status->name }}
                            </span>

                        </td>

                        <td class="small cc-muted">
                            {{ $report->created_at->format('d M') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center cc-muted py-4">
                            No reports submitted yet.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
