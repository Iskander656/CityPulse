@php
    $circumference = 2 * pi() * 45;

    $statusGauges = [
        [
            'label' => 'Pending',
            'value' => $pendingReports,
            'color' => '#f59e0b',
            'modifier' => 'pending',
        ],
        [
            'label' => 'Under Review',
            'value' => $underReviewReports,
            'color' => '#38bdf8',
            'modifier' => 'review',
        ],
        [
            'label' => 'In Progress',
            'value' => $inProgressReports,
            'color' => '#818cf8',
            'modifier' => 'progress',
        ],
        [
            'label' => 'Resolved',
            'value' => $resolvedReports,
            'color' => '#22c55e',
            'modifier' => 'resolved',
        ],
    ];
@endphp

<section class="admin-status-card cc-panel h-100">
    <div class="admin-status-card__header d-flex justify-content-between align-items-start gap-3 mb-4">
        <div>
            <div class="admin-section-eyebrow">REPORT DISTRIBUTION</div>
            <h5 class="admin-status-card__title mt-2 mb-0">Operational Status</h5>
            <p class="admin-status-card__subtitle mb-0 mt-2">Live breakdown of submitted reports.</p>
        </div>

        <div class="admin-status-card__icon" aria-hidden="true">
            <i class="bi bi-activity"></i>
        </div>
    </div>

    <div class="admin-status-grid">
        @foreach ($statusGauges as $gauge)
            @php
                $percentage = $totalReports > 0 ? ($gauge['value'] / $totalReports) * 100 : 0;
                $offset = $circumference * (1 - min(100, $percentage) / 100);
            @endphp

            <article class="admin-status-item admin-status-item--{{ $gauge['modifier'] }}">
                <div class="admin-status-ring">
                    <svg viewBox="0 0 100 100" role="img" aria-label="{{ $gauge['label'] }}: {{ $gauge['value'] }} reports, {{ number_format($percentage, 1) }} percent">
                        <circle class="admin-status-ring__track" cx="50" cy="50" r="45" />
                        <circle
                            class="admin-status-ring__progress"
                            cx="50"
                            cy="50"
                            r="45"
                            stroke="{{ $gauge['color'] }}"
                            stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $offset }}"
                        />
                    </svg>

                    <div class="admin-status-ring__content">
                        <div class="admin-status-ring__number">{{ number_format($gauge['value']) }}</div>
                    </div>
                </div>

                <div class="admin-status-item__label">{{ $gauge['label'] }}</div>
                <div class="admin-status-item__percentage">{{ number_format($percentage, 1) }}% <span>of reports</span></div>
            </article>
        @endforeach
    </div>
</section>
