@extends('layouts.admin')

@section('title', 'Form Menu')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Menu
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)

                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="type" id="type" aria-label="Default">
                            @foreach($types as $key => $type)
                            <option value="{{ $key }}" @if($menu->type == $key) selected @endif>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="parent_id" id="parent_id" aria-label="Default">
                            <option value="0">Root</option>
                            @foreach($parents as $key => $parent)
                            <option value="{{ $parent->id }}" @if($parent->id == $key) selected @endif>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $menu->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="code" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $menu->code }}">
                        @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ $menu->icon }}">
                        @error('icon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="order" class="col-sm-2 col-form-label">Order</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ $menu->order }}">
                        @error('order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="action" class="col-sm-2 col-form-label">Action</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('order') is-invalid @enderror" id="initial_action" name="initial_action" value="{{ $menu->initial_action }}">
                        @error('action')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('menu-management.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
