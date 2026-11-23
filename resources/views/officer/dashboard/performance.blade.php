<section class="officer-section-block">
    <div class="officer-section-heading">
        <div>
            <span class="officer-section-kicker">PERFORMANCE SNAPSHOT</span>
            <h2>Department overview</h2>
            <p>Current report activity across your department.</p>
        </div>
        <div class="officer-live-indicator"><span></span> LIVE OVERVIEW</div>
    </div>

    <div class="row g-3 officer-metrics-grid">
        <div class="col-6 col-xl-3">
            <article class="officer-metric-card officer-metric-total">
                <div class="officer-metric-top"><span>Total reports</span><span class="officer-metric-icon">▤</span></div>
                <div class="officer-metric-value">{{ $totalReports }}</div>
                <div class="officer-metric-foot">Reports received by your department</div>
                <div class="officer-metric-track"><span></span></div>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="officer-metric-card officer-metric-pending">
                <div class="officer-metric-top"><span>Pending review</span><span class="officer-metric-icon">◷</span>
                </div>
                <div class="officer-metric-value">{{ $pendingReports }}</div>
                <div class="officer-metric-foot">Waiting for officer attention</div>
                <div class="officer-metric-track"><span></span></div>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="officer-metric-card officer-metric-progress">
                <div class="officer-metric-top"><span>In progress</span><span class="officer-metric-icon">↗</span></div>
                <div class="officer-metric-value">{{ $inProgressReports }}</div>
                <div class="officer-metric-foot">Currently being addressed</div>
                <div class="officer-metric-track"><span></span></div>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="officer-metric-card officer-metric-resolved">
                <div class="officer-metric-top"><span>Resolved</span><span class="officer-metric-icon">✓</span>
                </div>
                <div class="officer-metric-value">{{ $resolvedReports }}</div>
                <div class="officer-metric-foot">Successfully completed reports</div>
                <div class="officer-metric-track"><span></span></div>
            </article>
        </div>
    </div>
</section>
