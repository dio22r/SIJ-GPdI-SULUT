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
                    <a href="{{ route('master-jemaat.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="35%">Nama</th>
                            <th scope="col" width="10%">Tgl. Lahir</th>
                            <th scope="col" width="15%">JK</th>
                            <th scope="col" width="15%">Status</th>
                            <th scope="col" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listJemaat as $jemaat)
                        <tr>
                            <th scope="row"> {{ $listJemaat->firstItem() + $loop->index }} </th>
                            <td>
                                <a href="{{ route('master-jemaat.detail', ['jemaat' => $jemaat->id]) }}">{{ $jemaat->name }}</a>
                                ({{ $jemaat->age }} thn)
                            </td>
                            <td>{{ $jemaat->date_birth }}</td>
                            <td>{{ $jemaat->formatSex() }}</td>
                            <td>{{ $jemaat->formatMaritalStatus() }}</td>
                            <td>
                                <a href="{{ route('master-jemaat.edit', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{ route('master-jemaat.delete', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive">
                {{ $listJemaat->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
