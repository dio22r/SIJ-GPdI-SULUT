@extends('layouts.admin')

@section('title', 'Data Hut')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Data Hari Ulang Tahun
        </div>
        <div class="card-body">
            <form class="row gx-3 gy-2 align-items-end mb-3">
                <div class="col-md-3">
                    <label for="specificSizeInputName">Tanggal Awal</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Tanggal Awal" value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <label for="specificSizeInputName">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Tanggal Akhir" value="{{ $endDate }}">
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>

            @if (!$isCustom)
            <h3 class="mb-3">Hut Sepekan</h3>
            @else
            <a href="{{ route('hut-sepekan.index') }}" class="btn btn-sm btn-light mb-3">Tampilkan Hut Sepekan</a>
            @endif

            @foreach($arrHut as $key => $hut)
            <div>
                <strong>{{ $hut["title"] }}</strong>
                <ul>
                    @foreach($hut["data"] as $jemaat)
                    <li>
                        <a href="{{ route('master-jemaat.detail', ['jemaat' => $jemaat]) }}">
                            {{ $jemaat->front_title }} {{ $jemaat->name }}
                        </a>
                        (<strong>{{ $jemaat->getAgeByDate($key) }}</strong> Thn)
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
