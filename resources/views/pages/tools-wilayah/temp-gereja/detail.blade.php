@extends('layouts.admin')

@section('title', 'Detail Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Gereja
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label for="name" class="col-md-2 col-form-label fw-bold">Nama</label>
                <div class="col-md-10">
                    <input type="text" class="form-control-plaintext @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="address" class="col-md-2 col-form-label fw-bold">Alamat</label>
                <div class="col-md-10">
                    <input type="text" class="form-control-plaintext @error('address') is-invalid @enderror" id="address" name="address" value="{{ $gereja->address }}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="pastor_name" class="col-md-2 col-form-label fw-bold">Nama Gembala</label>
                <div class="col-md-6">
                    <input type="text" class="form-control-plaintext @error('pastor_name') is-invalid @enderror" id="pastor_name" name="pastor_name" value="{{ $gereja->pastor_name }}">
                    @error('pastor_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="spouse_name" class="col-md-2 col-form-label fw-bold">Nama Ibu/Bpk Rohani</label>
                <div class="col-md-6">
                    <input type="text" class="form-control-plaintext @error('spouse_name') is-invalid @enderror" id="spouse_name" name="spouse_name" value="{{ $gereja->spouse_name }}">
                    @error('spouse_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="telp" class="col-md-2 col-form-label fw-bold">Telp.</label>
                <div class="col-md-6">
                    <input type="tel" class="form-control-plaintext @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ $gereja->telp }}">
                    @error('telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <label for="pelnap_l" class="col-md-2 col-form-label fw-bold">Pelnap Pria</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelnap_l') is-invalid @enderror" id="pelnap_l" name="pelnap_l" value="{{ $gereja->pelnap_l }}">
                    @error('pelnap_l')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="pelnap_p" class="col-md-2 col-form-label fw-bold">Pelnap Wanita</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelnap_p') is-invalid @enderror" id="pelnap_p" name="pelnap_p" value="{{ $gereja->pelnap_p }}">
                    @error('pelnap_p')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <label for="pelrap_l" class="col-md-2 col-form-label fw-bold">Pelrap Pria</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelrap_l') is-invalid @enderror" id="pelrap_l" name="pelrap_l" value="{{ $gereja->pelrap_l }}">
                    @error('pelrap_l')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="pelrap_p" class="col-md-2 col-form-label fw-bold">Pelrap Wanita</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelrap_p') is-invalid @enderror" id="pelrap_p" name="pelrap_p" value="{{ $gereja->pelrap_p }}">
                    @error('pelrap_p')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <label for="pelpap_l" class="col-md-2 col-form-label fw-bold">Pelpap Pria</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelpap_l') is-invalid @enderror" id="pelpap_l" name="pelpap_l" value="{{ $gereja->pelpap_l }}">
                    @error('pelpap_l')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="pelpap_p" class="col-md-2 col-form-label fw-bold">Pelpap Wanita</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelpap_p') is-invalid @enderror" id="pelpap_p" name="pelpap_p" value="{{ $gereja->pelpap_p }}">
                    @error('pelpap_p')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <label for="pelprip" class="col-md-2 col-form-label fw-bold">Pelprip</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelprip') is-invalid @enderror" id="pelprip" name="pelprip" value="{{ $gereja->pelprip }}">
                    @error('pelprip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="pelwap" class="col-md-2 col-form-label fw-bold">Pelwap</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('pelwap') is-invalid @enderror" id="pelwap" name="pelwap" value="{{ $gereja->pelwap }}">
                    @error('pelwap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <label for="kk" class="col-md-2 col-form-label fw-bold">Jumlah KK</label>
                <div class="col-md-4">
                    <input type="number" min="0" class="form-control-plaintext @error('kk') is-invalid @enderror" id="kk" name="kk" value="{{ $gereja->kk }}">
                    @error('kk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <hr />
            <div class="row mb-3">
                <div class="col-md-10 offset-md-2">
                    <a href="{{ route('wilayah-temp-gereja.index') }}" class="btn btn-sm btn-light">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
