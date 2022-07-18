@extends('layouts.admin')

@section('title', 'Master Keluarga')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Master Keluarga
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @can('create', new App\Models\MhKeluarga())
                    <a href="{{ route('master-keluarga.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    @endcan
                </div>
                <div class="col-md-4 offset-md-2">
                    <form method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Nama Keluarga" value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKeluarga as $keluarga)
                        <tr>
                            <th scope="row"> {{ $listKeluarga->firstItem() + $loop->index }} </th>
                            <td><a href="{{ route('master-keluarga.detail', ['keluarga' => $keluarga->id]) }}">{{ $keluarga->name }}</a></td>
                            <td>{{ Str::limit($keluarga->desc, 50, " ...") }}</td>
                            <td>{{ $keluarga->mh_jemaat_count }} Jiwa</td>
                            <td>
                                <form method="POST" action="{{ route('master-keluarga.destroy', ['keluarga' => $keluarga->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    @can('update', $keluarga)
                                    <a href="{{ route('master-keluarga.edit', ['keluarga' => $keluarga->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                    @endcan
                                    @can('delete', $keluarga)
                                    <button type="submit" class="btn btn-sm btn-danger ">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan

                                    @can('view', $keluarga)
                                    <a href="{{ route('master-keluarga.member', ['keluarga' => $keluarga->id]) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-list"></i>
                                    </a>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $listKeluarga->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection
