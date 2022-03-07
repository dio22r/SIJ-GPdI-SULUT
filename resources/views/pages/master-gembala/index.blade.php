@extends('layouts.admin')

@section('title', 'Daftar Gembala')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Gembala
        </div>
        <div class="card-body">
            @can('master-gembala_add')
            <a href="{{ route('master-gembala.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            @endcan
            <table class="table caption-top">
                <caption>List of Gembala</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal Lahir</th>
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
                        <td>{{ $gembala->birth_date }}</td>
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

@endsection
