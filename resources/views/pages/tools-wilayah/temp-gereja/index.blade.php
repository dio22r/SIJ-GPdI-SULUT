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
                    <a href="{{ route('wilayah-temp-gereja.create') }}" class="btn btn-sm btn-primary">
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
                        <th scope="col">KK</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listGereja as $gereja)
                    <tr>
                        <th scope="row"> {{ $listGereja->firstItem() + $loop->index }} </th>
                        <td>
                            <a href="{{ route('wilayah-temp-gereja.detail', ['gereja' => $gereja->id]) }}">
                                {{ $gereja->name }}
                            </a>
                        </td>
                        <td>
                            {{ $gereja->pastor_name }}
                        </td>
                        <td>
                            {{ optional($gereja->MhWilayah)->code }}
                            {{ optional($gereja->MhWilayah)->name }}
                        </td>
                        <td>{{ $gereja->kk }}</td>
                        <td>{{ $gereja->total }}</td>
                        <td>
                            <form method="POST" action="{{ route('wilayah-temp-gereja.destroy', ['gereja' => $gereja->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('wilayah-temp-gereja.edit', ['gereja' => $gereja->id]) }}" class="btn btn-sm btn-warning">
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
