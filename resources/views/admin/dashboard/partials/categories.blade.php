<section class="admin-categories-card cc-panel h-100">
    <div class="admin-categories-card__header mb-4">
        <div>
            <div class="admin-section-eyebrow">CITY INTELLIGENCE</div>
            <h5 class="admin-categories-card__title mt-2 mb-1">Top Issue Categories</h5>
            <p class="admin-categories-card__subtitle mb-0">The most frequently reported issue types.</p>
        </div>

        <span class="admin-categories-card__icon" aria-hidden="true">
            <i class="bi bi-layers"></i>
        </span>
    </div>

    @php
        $maxCategoryReports = max(1, (int) $categoryInsights->max('total_reports'));
    @endphp

    <div class="admin-categories-list">
        @forelse ($categoryInsights as $category)
            @php
                $categoryProgress = ($category->total_reports / $maxCategoryReports) * 100;
            @endphp

            <article class="admin-category-item">
                <div class="admin-category-item__heading">
                    <span class="admin-category-item__name">{{ $category->name }}</span>
                    <span class="admin-category-item__count">{{ number_format($category->total_reports) }}</span>
                </div>

                <progress
                    class="admin-category-progress"
                    value="{{ min(100, max(0, $categoryProgress)) }}"
                    max="100"
                    aria-label="{{ $category->name }} relative report volume"
                >{{ number_format($categoryProgress, 0) }}%</progress>
            </article>
        @empty
            <div class="admin-categories-empty">
                <i class="bi bi-inbox" aria-hidden="true"></i>
                <span>No category data available.</span>
            </div>
        @endforelse
    </div>
</section>
