@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <div class="col-md-6">
            <form method="GET">
                <div class="row">
                    <div class="col-auto">
                        <select name="filter" class="form-select" id="input-filter">
                            <option value="wilayah" @if(request('filter')=="wilayah" ) selected @endif>Wilayah</option>
                            <option value="all" @if(request('filter')=="all" ) selected @endif>All</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>Total Jiwa</strong>
                    <span class="badge float-end rounded-pill bg-warning text-white">{{ $stats->total ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>Total KK</strong> <span class="badge float-end rounded-pill bg-warning text-white">{{ $stats->total_kk ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>Total Pria</strong>
                    <span class="badge float-end rounded-pill bg-danger text-white">
                        {{ $stats->total_pelprip + $stats->total_pelpap_l + $stats->total_pelrap_l + $stats->total_pelnap_l}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-primary">
                <div class="card-body">
                    <strong>Total Wanita</strong>
                    <span class="badge float-end rounded-pill bg-primary text-white">
                        {{ $stats->total_pelwap + $stats->total_pelpap_p + $stats->total_pelrap_p + $stats->total_pelnap_p}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>PELPRIP</strong> <span class="badge float-end rounded-pill bg-danger text-white">{{ $stats->total_pelprip ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-primary">
                <div class="card-body">
                    <strong>PELWAP</strong> <span class="badge float-end rounded-pill bg-primary text-white">{{ $stats->total_pelwap ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>PELPAP</strong> <span class="badge float-end rounded-pill bg-warning text-white">{{ $stats->total_pelpap ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>PELRAP</strong> <span class="badge float-end rounded-pill bg-danger text-white">{{ $stats->total_pelrap ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-primary">
                <div class="card-body">
                    <strong>PELNAP</strong> <span class="badge float-end rounded-pill bg-primary text-white">{{ $stats->total_pelnap ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-warning">
                <div class="card-body">
                    <strong>GEMBALA</strong> <span class="badge float-end rounded-pill bg-warning text-white">{{ $totalGembala ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-light mb-4 border-danger">
                <div class="card-body">
                    <strong>JEMAAT</strong>
                    <span class="badge float-end rounded-pill bg-danger text-white">{{ $stats->total ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mt-4">JEMAAT TIAP KABUPATEN</h5>


    <div class="row">
        <div class="col-9">
            <div class="row">
                @foreach($listKabupaten as $key => $kabupaten)
                @php
                $arrColor = [
                "warning", "danger", "primary"
                ];
                $colorClass = $arrColor[$key % 3];
                @endphp

                <div class="col-lg-4 col-md-6">
                    <div class="card bg-light mb-4 border-{{ $colorClass }}">
                        <div class="card-body">
                            <strong>{{ strtoupper($kabupaten->nick_name) }}</strong>
                            <span class="badge float-end rounded-pill bg-{{ $colorClass }} text-white">{{ $kabupaten->total ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
@endsection