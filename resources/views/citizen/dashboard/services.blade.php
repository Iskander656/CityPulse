<section class="citizen-dashboard-section">
    <div class="citizen-dashboard-section-heading">
        <div>
            <span class="citizen-dashboard-section-label">YOUR WORKSPACE</span>
            <h2>How can we help today?</h2>
            <p>Choose an action to get started.</p>
        </div>
        <span class="citizen-dashboard-section-note">CITIZEN SERVICES <span>•</span> CITYPULSE</span>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <article class="citizen-dashboard-action-card citizen-dashboard-action-reports">
                <div class="citizen-dashboard-card-topline">
                    <span class="citizen-dashboard-action-icon" aria-hidden="true">▤</span>
                    <span class="citizen-dashboard-card-index">01 / TRACK</span>
                </div>
                <div class="citizen-dashboard-card-content">
                    <span class="citizen-dashboard-card-kicker">YOUR ACTIVITY</span>
                    <h3>My Reports</h3>
                    <p>Review the issues you've submitted, check their current status, and follow the progress
                        of your community reports.</p>
                </div>
                <a href="{{ route('citizen.reports.index') }}" class="citizen-dashboard-card-link">
                    <span>Explore my reports</span><span class="citizen-dashboard-link-arrow"
                        aria-hidden="true">→</span>
                </a>
            </article>
        </div>

        <div class="col-md-6">
            <article class="citizen-dashboard-action-card citizen-dashboard-action-create">
                <div class="citizen-dashboard-card-topline">
                    <span class="citizen-dashboard-action-icon" aria-hidden="true">＋</span>
                    <span class="citizen-dashboard-card-index">02 / REPORT</span>
                </div>
                <div class="citizen-dashboard-card-content">
                    <span class="citizen-dashboard-card-kicker">MAKE AN IMPACT</span>
                    <h3>Submit a Report</h3>
                    <p>Spotted something that needs attention? Share the details and location so the right city
                        team can respond.</p>
                </div>
                <a href="{{ route('citizen.reports.create') }}" class="citizen-dashboard-card-link">
                    <span>Create a new report</span><span class="citizen-dashboard-link-arrow"
                        aria-hidden="true">→</span>
                </a>
            </article>
        </div>
    </div>
</section>
