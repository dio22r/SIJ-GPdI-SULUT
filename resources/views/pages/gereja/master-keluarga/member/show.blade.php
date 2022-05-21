@extends('layouts.admin')

@section('title', 'Member ' . $keluarga->name)

@section('css')

@livewireStyles

@endsection

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Member: {{ $keluarga->name }}
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('master-keluarga.index') }}" class="btn btn-sm btn-dark">
                    <i class="fas fas-chevron-left"></i>List Keluarga
                </a>
            </div>
            @can('create', new App\Models\MhKeluarga())

            <form method="POST" action="{{ route('master-keluarga.member.add', ['keluarga' => $keluarga->id]) }}">
                @csrf
                <div class="row mb-3">
                    <label for="mh_gereja_id" class="col-sm-2 col-form-label">Jemaat</label>
                    <div class="col-sm-6">
                        <livewire:select-jemaat :idGereja="$keluarga->mh_gereja_id" />
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>

            @endcan
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="35%">Nama</th>
                            <th scope="col" width="15%">Tgl. Lahir</th>
                            <th scope="col" width="8%">Umur</th>
                            <th scope="col" width="7%">JK</th>
                            <th scope="col" width="15%">Status</th>
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
                                @can("delete", $keluarga)
                                <form method="POST" action="{{ route('master-keluarga.member.remove', ['keluarga' => $keluarga->id, 'member' => $jemaat->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $listJemaat->links() }}
        </div>
    </div>
</div>

@endsection

@section('js')

@livewireScripts

@endsection
