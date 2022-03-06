@extends('layouts.admin')

@section('title', 'Daftar Menu')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Daftar Menu
        </div>
        <div class="card-body">
            <a href="{{ route('menu-management.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <table class="table caption-top">
                <caption>List of User</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Order</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td>
                            <a href="{{ route('menu-management.detail', ['menu' => $menu->id]) }}">
                                {{ $menu->name }}
                            </a>
                        </td>
                        <td>
                            {{ $menu->code }}
                        </td>
                        <td>
                            <i class="{{ $menu->icon }}"></i>
                        </td>
                        <td>
                            {{ $menu->order }}
                        </td>
                        <td>
                            {{ $menu->formatType() }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('menu-management.destroy', ['menu' => $menu->id]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('menu-management.edit', ['menu' => $menu->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $menus->links() }}
        </div>
    </div>
</div>

@endsection
