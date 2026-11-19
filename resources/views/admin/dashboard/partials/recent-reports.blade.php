<section class="admin-recent-reports-card cc-panel">
    <div class="admin-recent-reports-card__header">
        <div>
            <div class="admin-section-eyebrow">LATEST ACTIVITY</div>
            <h5 class="admin-recent-reports-card__title mt-2 mb-1">Recent Reports</h5>
            <p class="admin-recent-reports-card__subtitle mb-0">The latest issues submitted across the city.</p>
        </div>

        <a href="{{ route('admin.reports.index') }}" class="admin-recent-reports-card__action">
            <span>View all reports</span>
            <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
        </a>
    </div>

    <div class="admin-recent-reports-table-wrap">
        <table class="admin-recent-reports-table">
            <thead>
                <tr>
                    <th scope="col">REPORT</th>
                    <th scope="col">DEPARTMENT</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">SUBMITTED</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($recentReports as $report)
                    <tr>
                        <td>
                            <div class="admin-recent-report-id">#{{ $report->id }}</div>
                            <div class="admin-recent-report-title">
                                {{ \Illuminate\Support\Str::limit($report->title, 35) }}
                            </div>
                        </td>

                        <td>
                            <span class="admin-recent-report-department">
                                {{ $report->department?->name ?? 'Unassigned' }}
                            </span>
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

                            <span class="admin-report-status admin-report-status--{{ $badgeColor }}">
                                <span class="admin-report-status__dot"></span>
                                {{ $report->status->name }}
                            </span>
                        </td>

                        <td>
                            <span class="admin-recent-report-date">
                                <i class="bi bi-calendar3" aria-hidden="true"></i>
                                {{ $report->created_at->format('d M') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="admin-recent-reports-empty">
                                <i class="bi bi-inbox" aria-hidden="true"></i>
                                <span>No reports submitted yet.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
