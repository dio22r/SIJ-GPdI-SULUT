@extends('layouts.admin')

@section('title', 'Form Gembala')

@section('css')

@livewireStyles

@endsection

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Gembala
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)
                <div class="row mb-3">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $gembala->nik }}">
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_kk" class="col-sm-2 col-form-label">No KK</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" name="no_kk" value="{{ $gembala->no_kk }}">
                        @error('no_kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gembala->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $gembala->address }}">
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
                        <input type="date" class="form-control @error('date_birth') is-invalid @enderror" id="date_birth" name="date_birth" value="{{ $gembala->date_birth }}">
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
                        <input type="text" class="form-control @error('place_birth') is-invalid @enderror" id="place_birth" name="place_birth" value="{{ $gembala->place_birth }}">
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
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ $gembala->telp }}" />
                        @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $gembala->email }}" />
                        @error('email')
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
                            <option value="L" @if($gembala->sex == 'L') selected @endif>
                                Laki-laki
                            </option>
                            <option value="P" @if($gembala->sex == 'P') selected @endif>
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
                            <option value="{{ $key }}" @if($gembala->marital_status == $key) selected @endif>
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
                    <label for="baptized_at" class="col-sm-2 col-form-label">Tanggal Baptis</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('baptized_at') is-invalid @enderror" id="baptized_at" name="baptized_at" value="{{ $gembala->baptized_at }}">
                        @error('baptized_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="baptized_place" class="col-sm-2 col-form-label">Tempat Baptis</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('baptized_place') is-invalid @enderror" id="baptized_place" name="baptized_place" value="{{ $gembala->baptized_place }}">
                        @error('baptized_place')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sk_no" class="col-sm-2 col-form-label">SK Gembala</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('sk_no') is-invalid @enderror" id="sk_no" name="sk_no" value="{{ $gembala->sk_no }}">
                        @error('sk_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sk_date" class="col-sm-2 col-form-label">Tanggal SK</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('sk_date') is-invalid @enderror" id="sk_date" name="sk_date" value="{{ $gembala->sk_date }}">
                        @error('sk_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sk_no" class="col-sm-2 col-form-label">Gereja</label>
                    <div class="col-sm-4">
                        <livewire:select-gereja :gereja="$gembala->MhGereja" />
                        @error('sk_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('master-gembala.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section("js")
<script src="https://cdn.tiny.cloud/1/lpvzaq0rzbkg7bnqy10wvlse1hxnz24d38s2vs2hfljxpggx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&v=weekly" async></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        plugins: 'lists link image imagetools ',
        toolbar: 'undo redo | styleselect | bold italic | numlist bullist | link image',
        height: 300
    });
</script>

@livewireScripts

@endsection
