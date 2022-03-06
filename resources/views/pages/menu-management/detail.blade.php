@extends('layouts.admin')

@section('title', 'Detail Menu')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Menu
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <h5>{{ $menu->name }}</h5>
                </dd>

                <dt class="col-sm-2">Kode</dt>
                <dd class="col-sm-10">
                    {{ $menu->code }}
                </dd>

                <dt class="col-sm-2">Icon</dt>
                <dd class="col-sm-10">
                    {{ $menu->icon }}
                </dd>

                <dt class="col-sm-2">Order</dt>
                <dd class="col-sm-10">
                    {{ $menu->order }}
                </dd>

                <dt class="col-sm-2">Tipe</dt>
                <dd class="col-sm-10">
                    {{ $menu->formatType() }}
                </dd>

                <dt class="col-sm-2">Action</dt>
                <dd class="col-sm-10">
                    {{ $menu->initial_action }}
                </dd>
            </dl>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
