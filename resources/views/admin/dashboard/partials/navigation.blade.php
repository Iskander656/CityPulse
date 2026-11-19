<section class="admin-navigation-card cc-panel">
    <div class="admin-navigation-card__header">
        <div>
            <div class="admin-section-eyebrow">CONTROL PANEL</div>
            <h5 class="admin-navigation-card__title mt-2 mb-1">System Administration</h5>
            <p class="admin-navigation-card__subtitle mb-0">
                Manage the people, departments and reports powering CityPulse.
            </p>
        </div>

        <div class="admin-navigation-card__icon" aria-hidden="true">
            <i class="bi bi-sliders"></i>
        </div>
    </div>

    <div class="admin-navigation-grid">
        <a href="{{ route('admin.users.index') }}" class="admin-navigation-link">
            <span class="admin-navigation-link__icon admin-navigation-link__icon--blue" aria-hidden="true">
                <i class="bi bi-people"></i>
            </span>
            <span class="admin-navigation-link__content">
                <span class="admin-navigation-link__title">Manage Users</span>
                <span class="admin-navigation-link__description">Review and manage platform accounts</span>
            </span>
            <i class="bi bi-arrow-up-right admin-navigation-link__arrow" aria-hidden="true"></i>
        </a>

        <a href="{{ route('admin.departments.index') }}" class="admin-navigation-link">
            <span class="admin-navigation-link__icon admin-navigation-link__icon--teal" aria-hidden="true">
                <i class="bi bi-diagram-3"></i>
            </span>
            <span class="admin-navigation-link__content">
                <span class="admin-navigation-link__title">Manage Departments</span>
                <span class="admin-navigation-link__description">Configure city service departments</span>
            </span>
            <i class="bi bi-arrow-up-right admin-navigation-link__arrow" aria-hidden="true"></i>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="admin-navigation-link admin-navigation-link--featured">
            <span class="admin-navigation-link__icon admin-navigation-link__icon--violet" aria-hidden="true">
                <i class="bi bi-clipboard-data"></i>
            </span>
            <span class="admin-navigation-link__content">
                <span class="admin-navigation-link__title">Global Report Management</span>
                <span class="admin-navigation-link__description">Monitor and coordinate all city reports</span>
            </span>
            <i class="bi bi-arrow-up-right admin-navigation-link__arrow" aria-hidden="true"></i>
        </a>
    </div>
</section>

<div class="admin-dashboard-footer">
    <span class="admin-dashboard-footer__line"></span>
    <span>CITYPULSE OPERATIONS PLATFORM</span>
    <span class="admin-dashboard-footer__separator">·</span>
    <span>ADMINISTRATIVE ACCESS</span>
    <span class="admin-dashboard-footer__line"></span>
</div>
