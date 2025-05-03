@extends('dashboard.layout')

@section('title', 'Total Revenue Report')

@section('content_header')
<x-header :title="__('reports.toltal_revenue_report')">

</x-header>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('revenueReport.total_revenue_chart') }}</h3>
        <select id="revenueFilter" class="form-control" style="width: 200px; display:inline-block; float: right;">
            <option value="daily">{{ __('revenueReport.last_7_days') }}</option>
            <option value="weekly">{{ __('revenueReport.last_6_weeks') }}</option>
            <option value="monthly">{{ __('revenueReport.last_6_months') }}</option>
        </select>
    </div>
    <div class="card-body">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

@push('js')
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart;

        function updateChart(type) {
            var labels = [];
            var data = [];

            if (type === 'daily') {
                labels = {!! json_encode($dailyRevenue->pluck('date')) !!};
                data = {!! json_encode($dailyRevenue->pluck('revenue')) !!};
            } else if (type === 'weekly') {
                labels = {!! json_encode($weeklyRevenue->pluck('week')) !!};
                data = {!! json_encode($weeklyRevenue->pluck('revenue')) !!};
            } else if (type === 'monthly') {
                labels = {!! json_encode($monthlyRevenue->pluck('month')) !!};
                data = {!! json_encode($monthlyRevenue->pluck('revenue')) !!};
            }

            if (revenueChart) {
                revenueChart.destroy();
            }

            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label:    "{{ __('revenueReport.total_revenue') }} " ,
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.getElementById('revenueFilter').addEventListener('change', function () {
            updateChart(this.value);
        });

        updateChart('daily'); // Load daily revenue by default
</script>

@endpush
@stop