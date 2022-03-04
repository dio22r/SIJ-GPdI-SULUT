@extends('layouts.admin')

@section('title', 'Detail User Group')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail User Group
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <h5>{{ $role->name }}</h5>
                </dd>

                <dt class="col-sm-2">Reference Table</dt>
                <dd class="col-sm-10">{{ $role->reference_table }}</dd>

            </dl>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
