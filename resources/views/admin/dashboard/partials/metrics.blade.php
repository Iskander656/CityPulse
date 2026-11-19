<div class="admin-metrics row g-3 g-xl-4 mb-4">
    <div class="col-6 col-xl-3">
        <article class="admin-metric-card admin-metric-card--reports h-100">
            <div class="admin-metric-card__top">
                <span class="admin-metric-card__label">Total Reports</span>
                <span class="admin-metric-card__icon" aria-hidden="true">
                    <i class="bi bi-clipboard-data"></i>
                </span>
            </div>
            <div class="admin-metric-card__value">{{ number_format($totalReports) }}</div>
            <div class="admin-metric-card__description">All submitted reports</div>
        </article>
    </div>

    <div class="col-6 col-xl-3">
        <article class="admin-metric-card admin-metric-card--citizens h-100">
            <div class="admin-metric-card__top">
                <span class="admin-metric-card__label">Citizens</span>
                <span class="admin-metric-card__icon" aria-hidden="true">
                    <i class="bi bi-people"></i>
                </span>
            </div>
            <div class="admin-metric-card__value">{{ number_format($totalUsers) }}</div>
            <div class="admin-metric-card__description">Registered platform users</div>
        </article>
    </div>

    <div class="col-6 col-xl-3">
        <article class="admin-metric-card admin-metric-card--departments h-100">
            <div class="admin-metric-card__top">
                <span class="admin-metric-card__label">Departments</span>
                <span class="admin-metric-card__icon" aria-hidden="true">
                    <i class="bi bi-buildings"></i>
                </span>
            </div>
            <div class="admin-metric-card__value">{{ number_format($totalDepartments) }}</div>
            <div class="admin-metric-card__description">Operational departments</div>
        </article>
    </div>

    <div class="col-6 col-xl-3">
        <article class="admin-metric-card admin-metric-card--officers h-100">
            <div class="admin-metric-card__top">
                <span class="admin-metric-card__label">Officers</span>
                <span class="admin-metric-card__icon" aria-hidden="true">
                    <i class="bi bi-shield-check"></i>
                </span>
            </div>
            <div class="admin-metric-card__value">{{ number_format($totalOfficers) }}</div>
            <div class="admin-metric-card__description">Department personnel</div>
        </article>
    </div>
</div>
