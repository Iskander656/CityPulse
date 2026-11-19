<div class="admin-charts-grid mb-4">

    {{-- Department Workload --}}
    <section class="admin-chart-card admin-chart-card--workload">
        <div class="admin-chart-card__header">
            <div>
                <div class="admin-section-eyebrow">RESOURCE ALLOCATION</div>
                <h5 class="admin-chart-card__title mt-2 mb-1">Department Workload</h5>
                <p class="admin-chart-card__subtitle mb-0">Reports assigned to each department</p>
            </div>
            <span class="admin-chart-card__icon admin-chart-card__icon--blue" aria-hidden="true">
                <i class="bi bi-bar-chart-line"></i>
            </span>
        </div>

        <div class="admin-chart-card__canvas">
            <canvas id="departmentChart" aria-label="Department workload chart" role="img"></canvas>
        </div>
    </section>

    {{-- Monthly Trends --}}
    <section class="admin-chart-card admin-chart-card--trends">
        <div class="admin-chart-card__header">
            <div>
                <div class="admin-section-eyebrow">CITY ACTIVITY</div>
                <h5 class="admin-chart-card__title mt-2 mb-1">Monthly Reporting Trends</h5>
                <p class="admin-chart-card__subtitle mb-0">Reports submitted over the last six months</p>
            </div>
            <span class="admin-chart-card__icon admin-chart-card__icon--teal" aria-hidden="true">
                <i class="bi bi-graph-up-arrow"></i>
            </span>
        </div>

        <div class="admin-chart-card__canvas">
            <canvas id="monthlyChart" aria-label="Monthly reporting trends chart" role="img"></canvas>
        </div>
    </section>

    {{-- Report Categories --}}
    <section class="admin-chart-card admin-chart-card--categories">
        <div class="admin-chart-card__header">
            <div>
                <div class="admin-section-eyebrow">ISSUE DISTRIBUTION</div>
                <h5 class="admin-chart-card__title mt-2 mb-1">Report Categories</h5>
                <p class="admin-chart-card__subtitle mb-0">Most frequently reported issues</p>
            </div>
            <span class="admin-chart-card__icon admin-chart-card__icon--violet" aria-hidden="true">
                <i class="bi bi-pie-chart"></i>
            </span>
        </div>

        <div class="admin-chart-card__canvas admin-chart-card__canvas--donut">
            <canvas id="categoryChart" aria-label="Report categories chart" role="img"></canvas>
        </div>
    </section>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Department workload
    new Chart(document.getElementById('departmentChart'), {
        type: 'bar',
        data: {
            labels: @json($departmentPerformance->pluck('name')),
            datasets: [{
                label: 'Total Reports',
                data: @json($departmentPerformance->pluck('total_reports')),
                backgroundColor: '#3b82f6',
                borderRadius: 8,
                barThickness: 22
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Monthly reporting trends
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: @json(collect($monthlyReportTrends)->pluck('month')),
            datasets: [{
                label: 'Reports',
                data: @json(collect($monthlyReportTrends)->pluck('total')),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#10b981'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Report categories
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: @json($categoryInsights->pluck('name')),
            datasets: [{
                data: @json($categoryInsights->pluck('total_reports')),
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '65%'
        }
    });

});
</script>
@endpush
