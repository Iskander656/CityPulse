<div class="cc-panel">

    <div class="cc-label">City Intelligence</div>

    <h5 class="fw-bold mt-2 mb-4">
        Top Issue Categories
    </h5>

    @php
        $maxCategoryReports = max(1, (int) $categoryInsights->max('total_reports'));
    @endphp

    @forelse ($categoryInsights as $category)
        <div class="mb-4">

            <div class="d-flex justify-content-between mb-2">

                <span class="small fw-semibold">
                    {{ $category->name }}
                </span>

                <span class="cc-muted small">
                    {{ $category->total_reports }}
                </span>

            </div>

            <div class="cc-progress">

                <div class="cc-progress-bar"
                    style="
                        width:{{ ($category->total_reports / $maxCategoryReports) * 100 }}%;
                        background:#e63946;
                     ">
                </div>

            </div>

        </div>

    @empty

        <p class="cc-muted">
            No category data available.
        </p>
    @endforelse

</div>
