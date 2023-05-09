@extends('layouts.admin')

@section('title', 'Daftar Gembala')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Gembala
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @can('master-gembala_add')
                    <a href="{{ route('master-gembala.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    @endcan
                </div>
                <div class="col-md-4 offset-md-2">
                    <form method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Nama Gembala" value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table caption-top">
                    <caption>List of Gembala</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Gereja</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listGembala as $gembala)
                        <tr>
                            <th scope="row"> {{ $listGembala->firstItem() + $loop->index }} </th>
                            <td>
                                <a href="{{ route('master-gembala.detail', ['gembala' => $gembala->id]) }}">
                                    {{ $gembala->name }}
                                </a>
                            </td>
                            <td>{{ $gembala->date_birth }}</td>
                            <td><strong>{{ $gembala->age }}</strong> Thn</td>
                            <td>
                                @if($gembala->MhGereja)
                                <a href="{{ route('master-gereja.detail', ['gereja' => $gembala->MhGereja->id]) }}">
                                    {{ $gembala->MhGereja->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('master-gembala.destroy', ['gembala' => $gembala->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    @can('master-gembala_update')
                                    <a href="{{ route('master-gembala.edit', ['gembala' => $gembala->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    @endcan
                                    @can('master-gembala_delete')
                                    <button type="submit" class="btn btn-sm btn-danger ">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $listGembala->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
