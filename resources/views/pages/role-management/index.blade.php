@extends('layouts.admin')

@section('title', 'Daftar User Group')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar User Group
        </div>
        <div class="card-body">
            <a href="{{ route('role-management.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <table class="table caption-top table-bordered table-striped">
                <caption>List of User Group</caption>
                <thead>
                    <tr class="table-light">
                        <th scope="col">#</th>
                        <th scope="col">Nama Group</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <th scope="row"> {{ $roles->firstItem() + $loop->index }} </th>
                        <td>
                            <a href="{{ route('role-management.detail', ['role' => $role->id]) }}">
                                {{ $role->name }}
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('role-management.destroy', ['role' => $role->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('role-management.edit', ['role' => $role->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger ">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="{{ route('role-management.permission', ['role' => $role->id]) }}" class="btn btn-sm btn-light">
                                    <i class="fas fa-cog"></i> Permision
                                </a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $roles->links() }}
        </div>
    </div>
</div>

@endsection
