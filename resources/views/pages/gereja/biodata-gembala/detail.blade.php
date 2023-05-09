@extends('layouts.admin')

@section('title', 'Detail Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Biodata Gembala
        </div>
        <div class="card-body">
            @if (!$gembala->id)
            <div class="alert alert-warning">Belum Ada Data Gembala</div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <dl class="row">
                        <dd class="col-sm-12">
                            <h5>{{ $gembala->name }} </h5>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->address }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tgl./Tempat Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->date_birth }} / {{ $gembala->place_birth }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Telp.</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->telp }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->email }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->formatSex() }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Status Pernikahan</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->formatMaritalStatus() }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tgl./Tempat Baptis</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->baptized_at }} / {{ $gembala->baptized_place }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">SK Gembala</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->sk_no }} / {{ $gembala->sk_date }}
                        </dd>
                    </dl>
                </div>
            </div>

            <a href="{{ route('biodata-gembala.edit') }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>


@endsection
