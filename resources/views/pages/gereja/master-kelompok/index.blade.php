@extends('layouts.admin')

@section('title', 'Master Kelompok')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Master Kelompok
        </div>
        <div class="card-body">
            @can('create', new App\Models\MhKelompok())
            <a href="{{ route('master-kelompok.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            @endcan
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Descripsi</th>
                            <th scope="col">Jumlah Jiwa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKelompok as $kelompok)
                        <tr>
                            <th scope="row"> {{ $listKelompok->firstItem() + $loop->index }} </th>
                            <td><a href="{{ route('master-kelompok.detail', ['kelompok' => $kelompok->id]) }}">{{ $kelompok->name }}</a></td>
                            <td>{{ $kelompok->desc }}</td>
                            <td>{{ $kelompok->mh_jemaat_count }}</td>
                            <td>
                                <form method="POST" action="{{ route('master-kelompok.destroy', ['kelompok' => $kelompok->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    @can('update', $kelompok)
                                    <a href="{{ route('master-kelompok.edit', ['kelompok' => $kelompok->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                    @endcan
                                    @can('delete', $kelompok)
                                    <button type="submit" class="btn btn-sm btn-danger ">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan
                                    <a href="{{ route('master-kelompok.member', ['kelompok' => $kelompok->id]) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-list"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $listKelompok->links() }}
        </div>
    </div>
</div>

@endsection
