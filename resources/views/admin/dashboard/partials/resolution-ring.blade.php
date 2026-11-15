@php
    $circumference = 2 * pi() * 45;
    $safeResolutionRate = min(100, max(0, $resolutionRate));
    $offset = $circumference * (1 - $safeResolutionRate / 100);
@endphp

<div class="cc-panel text-center">

    <div class="d-flex justify-content-between align-items-center">

        <div class="text-start">
            <div class="cc-label">Overall Performance</div>
            <h5 class="fw-bold mt-2 mb-0">Resolution Rate</h5>
        </div>

        <div class="cc-icon-box text-success">◉</div>

    </div>

    <div class="cc-ring" style="width:210px;height:210px;margin-top:30px;">

        <svg viewBox="0 0 100 100">

            <circle class="track" cx="50" cy="50" r="45" stroke-width="7" />

            <circle class="progress" cx="50" cy="50" r="45" stroke="#22c55e" stroke-width="7"
                stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"
                style="filter:drop-shadow(0 0 5px #22c55e);" />

        </svg>

        <div class="cc-ring-content">

            <div class="cc-ring-number text-success">
                {{ $resolutionRate }}%
            </div>

            <div class="cc-muted small">RESOLVED</div>

        </div>

    </div>

    <div class="row mt-3">

        <div class="col-6 border-end border-secondary">
            <h4 class="fw-bold mb-1">{{ $resolvedReports }}</h4>
            <div class="cc-muted small">Resolved reports</div>
        </div>

        <div class="col-6">
            <h4 class="fw-bold mb-1">
                {{ $totalReports - $resolvedReports - $rejectedReports }}
            </h4>
            <div class="cc-muted small">Active reports</div>
        </div>

    </div>

</div>
