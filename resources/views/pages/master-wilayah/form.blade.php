@extends('layouts.admin')

@section('title', 'Form User')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form User
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)
                <div class="row mb-3">
                    <label for="code" class="col-sm-2 col-form-label">Kode Wilayah</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Dalam Angka Romawi" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $wilayah->code }}">
                        @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama Wilayah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $wilayah->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mh_kabupaten_id" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="mh_kabupaten_id" id="mh_kabupaten_id" aria-label="Default">
                            @foreach($arrKabupaten as $kabupaten)
                            <option value="{{ $kabupaten->id }}" @if($kabupaten->id == $wilayah->mh_kabupaten_id) selected @endif>{{ $kabupaten->name }}</option>
                            @endforeach
                        </select>
                        @error('mh_kabupaten_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('master-wilayah.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
