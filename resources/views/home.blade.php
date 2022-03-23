@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>Total</strong>
                    <span class="badge float-end rounded-pill bg-warning text-white">{{ $countWadah['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>PELPRIP</strong> <span class="badge float-end rounded-pill bg-danger text-white">{{ $countWadah['PELPRIP'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-primary">
                <div class="card-body">
                    <strong>PELWAP</strong> <span class="badge float-end rounded-pill bg-primary text-white">{{ $countWadah['PELWAP'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>PELPAP</strong> <span class="badge float-end rounded-pill bg-warning text-white">{{ $countWadah['PELPAP'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>PELRAP</strong> <span class="badge float-end rounded-pill bg-danger text-white">{{ $countWadah['PELRAP'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6">
            <div class="card bg-light mb-4 border-primary">
                <div class="card-body">
                    <strong>PELNAP</strong> <span class="badge float-end rounded-pill bg-primary text-white">{{ $countWadah['PELNAP'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col col-12 col-md-6 col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Chart Pria / Wanita
                        </div>
                        <div class="card-body">
                            <canvas id="chart-gender" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-6 col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Chart Umur
                        </div>
                        <div class="card-body">
                            <canvas id="chart-umur" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Hut Hari Ini
                </div>
                <div class="card-body">
                    <strong>
                        {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                    </strong>
                    <ul>
                        @foreach($dataHut as $jemaat)
                        <li>
                            <a href="{{ route('master-jemaat.detail', ['jemaat' => $jemaat]) }}">
                                {{ $jemaat->front_title }} {{ $jemaat->name }}
                            </a>
                            (<strong>{{ $jemaat->getAgeByDate(Carbon\Carbon::now()->format("Y-m-d")) }}</strong> Thn)
                        </li>
                        @endforeach
                    </ul>

                    @if ($dataHut->count() == 0)
                    Tidak ada Ulang Tahun Hari ini.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('/js/Chart.min.js') }}"></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Pie Chart Example
    var ctx = document.getElementById("chart-gender");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: @json($countGender),
        options: {
            legend: {
                position: 'right'
            }
        }
    });


    // Bar Chart Example
    var ctx = document.getElementById("chart-umur");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: @json($countUmur),
        options: {
            legend: {
                display: false
            }
        }
    });
</script>
@endsection
