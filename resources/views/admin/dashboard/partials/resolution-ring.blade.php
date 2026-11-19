@php
    $circumference = 2 * pi() * 45;
    $safeResolutionRate = min(100, max(0, $resolutionRate));
    $offset = $circumference * (1 - $safeResolutionRate / 100);
@endphp

<section class="admin-resolution-card cc-panel text-center">
    <div class="admin-resolution-card__header d-flex justify-content-between align-items-center">
        <div class="text-start">
            <div class="admin-section-eyebrow">OVERALL PERFORMANCE</div>
            <h5 class="admin-resolution-card__title mt-2 mb-0">Resolution Rate</h5>
        </div>

        <div class="admin-resolution-card__icon" aria-hidden="true">
            <i class="bi bi-check2-circle"></i>
        </div>
    </div>

    <div class="admin-resolution-ring">
        <svg viewBox="0 0 100 100" role="img" aria-label="{{ $resolutionRate }} percent of reports resolved">
            <circle class="admin-resolution-ring__track" cx="50" cy="50" r="45" />
            <circle
                class="admin-resolution-ring__progress"
                cx="50"
                cy="50"
                r="45"
                stroke-dasharray="{{ $circumference }}"
                stroke-dashoffset="{{ $offset }}"
            />
        </svg>

        <div class="admin-resolution-ring__content">
            <div class="admin-resolution-ring__number">{{ $resolutionRate }}%</div>
            <div class="admin-resolution-ring__caption">RESOLVED</div>
        </div>
    </div>

    <div class="admin-resolution-stats row mt-3">
        <div class="col-6 admin-resolution-stats__item">
            <h4 class="admin-resolution-stats__value mb-1">{{ $resolvedReports }}</h4>
            <div class="admin-resolution-stats__label">Resolved reports</div>
        </div>

        <div class="col-6 admin-resolution-stats__item">
            <h4 class="admin-resolution-stats__value mb-1">
                {{ $totalReports - $resolvedReports - $rejectedReports }}
            </h4>
            <div class="admin-resolution-stats__label">Active reports</div>
        </div>
    </div>
</section>
