@extends('layouts.admin')

@section('title', 'Daftar Gereja')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Gereja
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('master-gereja.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="col-md-4 offset-md-2">
                    <form method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Nama Gereja" value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table caption-top">
                <caption>List of Gereja</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Gembala</th>
                        <th scope="col">Wilayah</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listGereja as $gereja)
                    <tr>
                        <th scope="row"> {{ $listGereja->firstItem() + $loop->index }} </th>
                        <td>
                            <a href="{{ route('master-gereja.detail', ['gereja' => $gereja->id]) }}">
                                {{ $gereja->name }}
                            </a>
                        </td>
                        <td>
                            @if($gereja->MhGembala)
                            <a href="{{ route('master-gembala.detail', ['gembala' => $gereja->MhGembala->id]) }}">
                                {{ $gereja->MhGembala->name }}
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($gereja->MhWilayah)
                            <a href="{{ route('master-wilayah.detail', ['wilayah' => $gereja->MhWilayah->id]) }}">
                                {{ optional($gereja->MhWilayah)->code }}
                                {{ optional($gereja->MhWilayah)->name }}
                            </a>
                            @endif
                        </td>
                        <td>{{ $gereja->mh_jemaat_count }}</td>
                        <td>
                            <form method="POST" action="{{ route('master-gereja.destroy', ['gereja' => $gereja->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('master-gereja.edit', ['gereja' => $gereja->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $listGereja->links() }}
        </div>
    </div>
</div>

@endsection
