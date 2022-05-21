@extends('layouts.admin')

@section('title', 'Master Keluarga')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Master Keluarga
        </div>
        <div class="card-body">
            @can('create', new App\Models\MhKeluarga())
            <a href="{{ route('master-keluarga.create') }}" class="btn btn-sm btn-primary">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKeluarga as $keluarga)
                        <tr>
                            <th scope="row"> {{ $listKeluarga->firstItem() + $loop->index }} </th>
                            <td><a href="{{ route('master-keluarga.detail', ['keluarga' => $keluarga->id]) }}">{{ $keluarga->name }}</a></td>
                            <td>{{ $keluarga->desc }}</td>
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

            {{ $listKeluarga->links() }}
        </div>
    </div>
</div>

@endsection
