<section class="officer-reports-panel">
    <div class="officer-panel-header">
        <div>
            <span class="officer-section-kicker">RECENT ACTIVITY</span>
            <h2>Recent department reports</h2>
            <p>A quick look at the newest reports assigned to your department.</p>
        </div>
        <a href="{{ route('officer.reports.index') }}" class="officer-view-all">View all reports <span
                aria-hidden="true">→</span></a>
    </div>

    @if ($recentReports->isEmpty())
        <div class="officer-empty-state">
            <div class="officer-empty-icon">⌕</div>
            <h3>No reports yet</h3>
            <p>There are currently no reports assigned to your department.</p>
        </div>
    @else
        <div class="table-responsive officer-table-wrap">
            <table class="table officer-reports-table align-middle">
                <thead>
                    <tr>
                        <th>REPORT</th>
                        <th>CATEGORY</th>
                        <th>SUBMITTED BY</th>
                        <th>STATUS</th>
                        <th>DATE SUBMITTED</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentReports as $report)
                        <tr>
                            <td>
                                <span class="officer-report-title">{{ $report->title }}</span>
                                <span class="officer-report-id">REPORT #{{ $report->id }}</span>
                            </td>
                            <td>{{ $report->category->name }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td><span class="officer-status-badge">{{ $report->status->name }}</span></td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
