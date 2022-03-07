@extends('layouts.admin')

@section('title', 'Daftar User')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar User
        </div>
        <div class="card-body">
            <a href="{{ route('user-management.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <table class="table caption-top">
                <caption>List of User</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row"> {{ $users->firstItem() + $loop->index }} </th>
                        <td><a href="{{ route('user-management.detail', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role->count() > 0)
                            @foreach ($user->role as $role)
                            {{ $role->name }},
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('user-management.destroy', ['user' => $user->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('user-management.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
