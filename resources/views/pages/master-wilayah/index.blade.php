@extends('layouts.admin')

@section('title', 'Daftar Wilayah')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Wilayah
        </div>
        <div class="card-body">
            <a href="{{ route('master-wilayah.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <table class="table caption-top">
                <caption>List of Wilayah</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Wilayah</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kabupaten / Kota</th>
                        <th scope="col">Gereja</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listWilayah as $wilayah)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td>{{ $wilayah->code }}</td>
                        <td><a href="{{ route('master-wilayah.detail', ['wilayah' => $wilayah->id]) }}">{{ $wilayah->name }}</a></td>
                        <td>{{ $wilayah->MhKabupaten->name }}</td>
                        <td>{{ $wilayah->mh_gereja_count }}</td>
                        <td>
                            <form method="POST" action="{{ route('master-wilayah.destroy', ['wilayah' => $wilayah->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('master-wilayah.edit', ['wilayah' => $wilayah->id]) }}" class="btn btn-sm btn-warning">
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

            {{ $listWilayah->links() }}
        </div>
    </div>
</div>

@endsection
