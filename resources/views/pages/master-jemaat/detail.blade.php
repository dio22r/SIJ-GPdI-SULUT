@extends('layouts.admin')

@section('title', 'Detail Jemaat')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Jemaat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <dl class="row">
                        <dd class="col-sm-12">
                            <h5>{{ $jemaat->name }} </h5>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->address }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tanggal Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->date_birth }}
                            <strong>({{ $jemaat->age }} thn)</strong>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tempat Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->place_birth }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->formatSex() }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->formatMaritalStatus() }}
                        </dd>
                    </dl>
                </div>
            </div>


            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
