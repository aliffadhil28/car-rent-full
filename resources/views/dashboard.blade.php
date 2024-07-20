@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="shadow-md sm:rounded-sm">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> <!-- Pastikan pustaka ApexCharts dimuat -->
    <script>
        var carNames = @json($carNames);
        var carCounts = @json($carCounts);

        var options = {
            chart: {
                type: 'bar',
            },

            series: [{
                name: 'Rent',
                data: carCounts
            }],
            xaxis: {
                categories: carNames
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endsection
