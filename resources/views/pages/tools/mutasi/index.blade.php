@extends('layouts.admin')

@section('title', 'Daftar Gereja')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Mutasi Jemaat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link @if($status == -1) active @endif"
                                aria-current="page"
                                href="{{ route("mutasi-jemaat.index", ["status" => "meninggal"]) }}"
                                >
                                Meninggal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($status == -2) active @endif"
                                href="{{ route("mutasi-jemaat.index", ["status" => "pindah"]) }}"
                                >
                            Pindah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($status == 0) active @endif"
                                href="{{ route("mutasi-jemaat.index", ["status" => "pending"]) }}"
                                >Pending
                            </a>
                        </li>
                    </ul>
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
                            <th scope="col" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listJemaat as $jemaat)
                        <tr>
                            <th scope="row"> {{ $listJemaat->firstItem() + $loop->index }} </th>
                            <td>
                                <a href="{{ route('mutasi-jemaat.show', ['jemaat' => $jemaat->id]) }}">{{ $jemaat->name }}</a>
                            </td>
                            <td>{{ $jemaat->date_birth }}</td>
                            <td><strong>{{ $jemaat->age }} thn</strong></td>
                            <td>{{ $jemaat->sex }}</td>
                            <td>{{ $jemaat->mutation_formated }}</td>
                            <td>
                                @can("update", $jemaat)
                                <a href="{{ route('mutasi-jemaat.edit', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan

                                @can("delete", $jemaat)
                                <a href="{{ route('mutasi-jemaat.delete', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-danger">
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
