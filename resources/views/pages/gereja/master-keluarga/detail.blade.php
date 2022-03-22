@extends('layouts.admin')

@section('title', 'Detail Keluarga')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Keluarga
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <h5>{{ $keluarga->name }}</h5>
                </dd>

                <dt class="col-sm-2">Deskripsi</dt>
                <dd class="col-sm-10">{{ $keluarga->desc }}</dd>

            </dl>
            <a href="{{ route('master-keluarga.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
