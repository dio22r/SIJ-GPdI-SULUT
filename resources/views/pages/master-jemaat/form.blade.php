@extends('layouts.admin')

@section('title', 'Form Jemaat')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Jemaat
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $jemaat->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $jemaat->address }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date_birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('date_birth') is-invalid @enderror" id="date_birth" name="date_birth" value="{{ $jemaat->date_birth }}">
                        @error('date_birth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="place_birth" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('place_birth') is-invalid @enderror" id="place_birth" name="place_birth" value="{{ $jemaat->place_birth }}">
                        @error('place_birth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Telp.</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ $jemaat->telp }}" />
                        @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sex" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-5">
                        <select class="form-select" name="sex" id="sex" aria-label="Default">
                            <option value="L" @if($jemaat->sex == 'L') selected @endif>
                                Laki-laki
                            </option>
                            <option value="P" @if($jemaat->sex == 'P') selected @endif>
                                Perempuan
                            </option>
                        </select>
                        @error('sex')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="marital_status" class="col-sm-2 col-form-label">Status Pernikahan</label>
                    <div class="col-sm-5">
                        <select class="form-select" name="marital_status" id="marital_status" aria-label="Default">
                            @foreach($arrMaritalStatus as $key => $status)
                            <option value="{{ $key }}" @if($jemaat->marital_status == $key) selected @endif>
                                {{ $status }}
                            </option>
                            @endforeach
                        </select>
                        @error('marital_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('master-jemaat.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
