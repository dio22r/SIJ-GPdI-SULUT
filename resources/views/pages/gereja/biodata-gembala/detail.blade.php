@extends('layouts.admin')

@section('title', 'Detail Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Gereja
        </div>
        <div class="card-body">
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
                        <dt class="col-sm-4">Tanggal Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $gembala->birth_date }}
                        </dd>
                    </dl>
                </div>
            </div>

            <a href="{{ route('biodata-gembala.edit') }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>


@endsection
