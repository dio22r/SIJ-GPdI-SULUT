@extends('layouts.admin')

@section('title', 'Daftar Gereja')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Jemaat
        </div>
        <div class="card-body">
            <a href="{{ route('master-jemaat.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <table class="table caption-top">
                <caption>List of Jemaat</caption>
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
                            <form method="POST" action="{{ route('master-jemaat.destroy', ['jemaat' => $jemaat->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('master-jemaat.edit', ['jemaat' => $jemaat->id]) }}" class="btn btn-sm btn-warning">
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

            {{ $listJemaat->links() }}
        </div>
    </div>
</div>

@endsection
