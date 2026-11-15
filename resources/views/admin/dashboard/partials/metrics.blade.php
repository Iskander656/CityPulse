<div class="row g-3 mb-4">

    <div class="col-6 col-xl-3">
        <div class="cc-metric">
            <div class="cc-label">Total Reports</div>
            <div class="cc-metric-number text-white">
                {{ number_format($totalReports) }}
            </div>
            <div class="cc-muted small mt-2">All submitted reports</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="cc-metric">
            <div class="cc-label">Citizens</div>
            <div class="cc-metric-number text-info">
                {{ number_format($totalUsers) }}
            </div>
            <div class="cc-muted small mt-2">Registered platform users</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="cc-metric">
            <div class="cc-label">Departments</div>
            <div class="cc-metric-number text-primary">
                {{ number_format($totalDepartments) }}
            </div>
            <div class="cc-muted small mt-2">Operational departments</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="cc-metric">
            <div class="cc-label">Officers</div>
            <div class="cc-metric-number text-warning">
                {{ number_format($totalOfficers) }}
            </div>
            <div class="cc-muted small mt-2">Department personnel</div>
        </div>
    </div>

</div>
