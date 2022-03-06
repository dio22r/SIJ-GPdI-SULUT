@extends('layouts.admin')

@section('title', 'Form Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Gereja
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Tanggal SK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Profil</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Jadwal ibadah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mh_wilayah_id" class="col-sm-2 col-form-label">Wilayah</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="mh_wilayah_id" id="mh_wilayah_id" aria-label="Default">
                            @foreach($arrWilayah as $wilayah)
                            <option value="{{ $wilayah->id }}" @if($wilayah->id == $gereja->mh_wilayah_id) selected @endif>
                                {{ $wilayah->code }} {{ $wilayah->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('mh_wilayah_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('master-gereja.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
