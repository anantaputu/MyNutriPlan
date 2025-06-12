@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<section id="dashboard" class="py-10">
    <div class="container py-5">
        <h2 class="mb-4">Admin Dashboard</h2>
        {{-- Kartu Statistik --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card shadow-sm rounded-4 text-center p-3">
                    <h5>Total Users</h5>
                    <p class="fs-4 fw-bold">{{ $userCount }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-4 text-center p-3">
                    <h5>Total Food Materials</h5>
                    <p class="fs-4 fw-bold">{{ $foodMaterialCount }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-4 text-center p-3">
                    <h5>Total Menus</h5>
                    <p class="fs-4 fw-bold">{{ $menuCount }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-4 text-center p-3">
                    <h5>Total Articles</h5>
                    <p class="fs-4 fw-bold">{{ $articleCount }}</p>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-sm rounded-4 p-4">
                    <h4 class="mb-4">User Growth Overview</h4>
                    <div id="adminApexChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Menggunakan data dinamis dari controller untuk chart
    var options = {
        chart: {
            type: 'line',
            height: 350,
            toolbar: { show: false }
        },
        series: [{
            name: 'Total Users',
            data: @json($totalUsersData) // Data dari controller
        }, {
            name: 'Active Users',
            data: @json($activeUsersData) // Data dari controller
        }],
        xaxis: {
            categories: @json($chartLabels) // Label dari controller
        },
        colors: ['#0d6efd', '#198754'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        legend: { position: 'top' },
        grid: { borderColor: '#eee' }
    };
    var chart = new ApexCharts(document.querySelector("#adminApexChart"), options);
    chart.render();
</script>
@endpush