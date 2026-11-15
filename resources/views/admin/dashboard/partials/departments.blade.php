<div class="cc-panel mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <div class="cc-label">Organizational Monitoring</div>
            <h5 class="fw-bold mt-2 mb-0">Department Performance</h5>
        </div>

        <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-light cc-btn btn-sm">
            Manage Departments →
        </a>

    </div>

    <div class="table-responsive">

        <table class="table cc-table align-middle">

            <thead>
                <tr>
                    <th>Department</th>
                    <th>Total Reports</th>
                    <th>In Progress</th>
                    <th>Resolved</th>
                    <th>Resolution Progress</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($departmentPerformance as $department)
                    @php
                        $departmentRate =
                            $department->total_reports > 0
                                ? ($department->resolved_reports / $department->total_reports) * 100
                                : 0;
                    @endphp

                    <tr>

                        <td class="fw-semibold">
                            {{ $department->name }}
                        </td>

                        <td>{{ $department->total_reports }}</td>

                        <td>
                            <span class="text-primary fw-bold">
                                {{ $department->in_progress_reports }}
                            </span>
                        </td>

                        <td>
                            <span class="text-success fw-bold">
                                {{ $department->resolved_reports }}
                            </span>
                        </td>

                        <td style="min-width:150px;">

                            <div class="d-flex justify-content-between small mb-2">

                                <span class="cc-muted">Completion</span>

                                <span class="text-success">
                                    {{ number_format($departmentRate, 0) }}%
                                </span>

                            </div>

                            <div class="cc-progress">

                                <div class="cc-progress-bar bg-success" style="width:{{ $departmentRate }}%">
                                </div>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center cc-muted py-4">
                            No department data available.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
