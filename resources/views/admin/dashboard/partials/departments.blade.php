<section class="admin-departments-card cc-panel mb-4">
    <div class="admin-departments-card__header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <div class="admin-section-eyebrow">ORGANIZATIONAL MONITORING</div>
            <h5 class="admin-departments-card__title mt-2 mb-0">Department Performance</h5>
            <p class="admin-departments-card__subtitle mt-2 mb-0">A department-level view of report resolution.</p>
        </div>

        <a href="{{ route('admin.departments.index') }}" class="admin-departments-card__action">
            <span>Manage Departments</span>
            <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
        </a>
    </div>

    <div class="table-responsive admin-departments-table-wrap">
        <table class="table admin-departments-table align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col">Department</th>
                    <th scope="col">Total Reports</th>
                    <th scope="col">In Progress</th>
                    <th scope="col">Resolved</th>
                    <th scope="col">Resolution Progress</th>
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
                        <td class="admin-departments-table__name">
                            {{ $department->name }}
                        </td>

                        <td>{{ $department->total_reports }}</td>

                        <td>
                            <span class="admin-departments-table__count admin-departments-table__count--progress">
                                {{ $department->in_progress_reports }}
                            </span>
                        </td>

                        <td>
                            <span class="admin-departments-table__count admin-departments-table__count--resolved">
                                {{ $department->resolved_reports }}
                            </span>
                        </td>

                        <td class="admin-departments-table__completion">
                            <div class="admin-departments-table__completion-heading">
                                <span>Completion</span>
                                <span class="admin-departments-table__rate">{{ number_format($departmentRate, 0) }}%</span>
                            </div>

                            <progress
                                class="admin-departments-progress"
                                value="{{ min(100, max(0, $departmentRate)) }}"
                                max="100"
                                aria-label="{{ $department->name }} resolution progress"
                            >{{ number_format($departmentRate, 0) }}%</progress>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-departments-table__empty">
                            <i class="bi bi-inbox" aria-hidden="true"></i>
                            <span>No department data available.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
