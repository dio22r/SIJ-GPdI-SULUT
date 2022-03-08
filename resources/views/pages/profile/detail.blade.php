@extends('layouts.admin')

@section('title', 'Detail Account')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Account
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

            <a href="{{ route('account.edit') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
                Edit Account
            </a>
            @if (!auth()->user()->hasVerifiedEmail())
            <form class="d-inline" method="post" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-warning">
                    <i class="fas fa-envelope"></i>
                    Send Verified Email
                </button>
            </form>
            @endif
        </div>
    </div>
</div>


@endsection
