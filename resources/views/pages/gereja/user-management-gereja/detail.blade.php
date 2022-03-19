@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail User
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <h5>{{ $user->name }}</h5>
                </dd>

                <dt class="col-sm-2">Email</dt>
                <dd class="col-sm-10">{{ $user->email }}</dd>

                <dt class="col-sm-2">User Role</dt>
                <dd class="col-sm-10">
                    <ul>
                        @foreach ($user->role as $role)
                        <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                </dd>
            </dl>
            <a href="{{ route('user-management-gereja.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
