@extends('layouts.admin')

@section('title', 'Detail Jemaat')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Jemaat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <dl class="row">
                        <dd class="col-sm-12">
                            <h5>{{ $jemaat->name }} </h5>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->address }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tanggal Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->date_birth }}
                            <strong>({{ $jemaat->age }} thn)</strong>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tempat Lahir</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->place_birth }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->formatSex() }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            {{ $jemaat->formatMaritalStatus() }}
                        </dd>
                    </dl>
                </div>
            </div>
            <form method="POST" action="{{ route('master-jemaat.destroy', ['jemaat' => $jemaat->id]) }}">
                @method('DELETE')
                @csrf
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Alasan dihapus</label>
                    <div class="col-sm-5">
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="sex" aria-label="Default">
                            <option value="0" @if(old('status')==0) selected @endif>
                                Data Tidak Valid
                            </option>
                            <option value="-1" @if(old('status')==-1) selected @endif>
                                Meninggal
                            </option>
                            <option value="-2" @if(old('status')==-2) selected @endif>
                                Pindah
                            </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="date_end" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('date_end') is-invalid @enderror" id="date_end" name="date_end" value="{{ old('date_end') }}">
                        @error('date_end')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
