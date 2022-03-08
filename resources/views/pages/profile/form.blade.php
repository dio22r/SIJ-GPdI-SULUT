@extends('layouts.admin')

@section('title', 'Edit Account')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Edit Account
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama User</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Password Confirmation</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('account.edit') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
