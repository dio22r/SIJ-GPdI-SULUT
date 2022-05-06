@extends('layouts.app')

@section('content')
<div class="container py-5" id="app-vue-register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ $actionUrl }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mh_wilayah_id" class="col-md-4 col-form-label text-md-end">Wilayah</label>

                            <div class="col-md-6">
                                <select name="mh_wilayah_id" id="mh_wilayah_id" class="form-select" v-model="mh_wilayah_id" v-on:change="retrieveGereja">
                                    @foreach($listWilayah as $wilayah)
                                    <option value="{{ $wilayah->id }}" @if($wilayah->id == old('mh_wilayah_id')) selected @endif>
                                        {{ $wilayah->code }}
                                        {{ $wilayah->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ref_id" class="col-md-4 col-form-label text-md-end">
                                <div id="spinner" class="spinner-grow spinner-grow-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                Gereja
                            </label>

                            <div class="col-md-6">
                                <select name="ref_id" id="ref_id" class="form-select">
                                    <option v-for="gereja in listGereja" :value="gereja.id">
                                        @{{ gereja.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('/js/axios.min.js') }}"></script>
<script src="{{ url('/js/vue2.js') }}"></script>
<script>
    var app_register = new Vue({
        el: "#app-vue-register",
        data: {
            listGereja: [],
            mh_wilayah_id: 0,
        },

        methods: {
            retrieveGereja: function() {
                let self = this;

                let loading = document.getElementById('spinner');
                loading.classList.remove('d-none');
                axios.get("{{ route('resource.gereja-by-wilayah') }}", {
                        params: {
                            mh_wilayah_id: this.mh_wilayah_id
                        }
                    })
                    .then((response) => {
                        self.listGereja = response.data;
                        loading.classList.add('d-none');
                    })
                    .catch((error) => {
                        self.listGereja = [];
                        loading.classList.add('d-none');
                    });
            },

        },
        mounted: function() {
            console.log("Test");
        }
    });
</script>
@endsection
