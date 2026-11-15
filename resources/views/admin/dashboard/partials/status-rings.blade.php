@php
    $circumference = 2 * pi() * 45;

    $statusGauges = [
        [
            'label' => 'Pending',
            'value' => $pendingReports,
            'color' => '#f59e0b',
        ],
        [
            'label' => 'Under Review',
            'value' => $underReviewReports,
            'color' => '#38bdf8',
        ],
        [
            'label' => 'In Progress',
            'value' => $inProgressReports,
            'color' => '#818cf8',
        ],
        [
            'label' => 'Resolved',
            'value' => $resolvedReports,
            'color' => '#22c55e',
        ],
    ];
@endphp

<div class="cc-panel">

    <div class="mb-4">
        <div class="cc-label">Report Distribution</div>
        <h5 class="fw-bold mt-2 mb-0">Operational Status</h5>
    </div>

    <div class="row g-4">

        @foreach ($statusGauges as $gauge)
            @php
                $percentage = $totalReports > 0 ? ($gauge['value'] / $totalReports) * 100 : 0;

                $offset = $circumference * (1 - min(100, $percentage) / 100);
            @endphp

            <div class="col-6">

                <div class="text-center">

                    <div class="cc-ring cc-small-ring">

                        <svg viewBox="0 0 100 100">

                            <circle class="track" cx="50" cy="50" r="45" />

                            <circle class="progress" cx="50" cy="50" r="45" stroke="{{ $gauge['color'] }}"
                                stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"
                                style="filter:drop-shadow(0 0 4px {{ $gauge['color'] }});" />

                        </svg>

                        <div class="cc-ring-content">

                            <div class="cc-ring-number" style="color:{{ $gauge['color'] }}">
                                {{ $gauge['value'] }}
                            </div>

                        </div>

                    </div>

                    <div class="fw-semibold mt-2">
                        {{ $gauge['label'] }}
                    </div>

                    <div class="cc-muted small">
                        {{ number_format($percentage, 1) }}% of reports
                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>
