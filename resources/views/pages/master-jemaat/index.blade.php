@extends('layouts.admin')

@section('title', 'Daftar Gereja')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Jemaat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @can("create", new App\Models\MhJemaat())
                    <a href="{{ route('master-jemaat.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    @endcan
                </div>
                <div class="col-md-4 offset-md-2">
                    <form method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Nama Jemaat" value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="35%">Nama</th>
                            <th scope="col" width="15%">Tgl. Lahir</th>
                            <th scope="col" width="8%">Umur</th>
                            <th scope="col" width="7%">JK</th>
                            <th scope="col" width="8%">Status</th>
                            <th scope="col" width="7%">
                                <i class="fas fa-home"></i> |
                                <i class="fas fa-users"></i>
                            </th>
                            <th scope="col" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listJemaat as $jemaat)
                        <tr>
                            <th scope="row"> {{ $listJemaat->firstItem() + $loop->index }} </th>
                            <td>
                                <a href="{{ route('master-jemaat.detail', ['jemaat' => $jemaat->id]) }}">{{ $jemaat->name }}</a>
                            </td>
                            <td>{{ $jemaat->date_birth }}</td>
                            <td><strong>{{ $jemaat->age }} thn</strong></td>
                            <td>{{ $jemaat->sex }}</td>
                            <td>{{ $jemaat->formatMaritalStatus() }}</td>
                            <td>
                                @if($jemaat->mh_keluarga_id)
                                <i class="fas fa-home"></i>
                                @endif
                                @if($jemaat->mh_kelompok_id)
                                <i class="fas fa-users"></i>
                                @endif
                            </td>
                            <td>
                                @can("update", $jemaat)
                                <a href="{{ route('master-jemaat.edit', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan

                                @can("delete", $jemaat)
                                <a href="{{ route('master-jemaat.delete', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive">
                {{ $listJemaat->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
