@extends('layouts.admin')

@section('title', 'Daftar Gereja')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Gereja
        </div>
        <div class="card-body">
            <a href="{{ route('master-gereja.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
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
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td>
                            <a href="{{ route('master-gereja.detail', ['gereja' => $gereja->id]) }}">
                                {{ $gereja->name }}
                            </a>
                        </td>
                        <td>{{ optional($gereja->MhGembala)->name }}</td>
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
