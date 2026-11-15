<div class="row g-4 mb-4">

    {{-- Department Workload --}}
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Department Workload</h5>
                <p class="text-muted small mb-4">Reports assigned to each department</p>
                <div style="height: 300px;">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Monthly Trends --}}
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Monthly Reporting Trends</h5>
                <p class="text-muted small mb-4">Reports submitted over the last six months</p>
                <div style="height: 300px;">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Report Categories --}}
    <div class="col-12 col-xl-5">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Report Categories</h5>
                <p class="text-muted small mb-4">Most frequently reported issues</p>
                <div style="height: 300px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

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
