@extends('layouts.admin')

@section('title', 'Group Permission')

@section('content')

<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Hak Akses Group: {{ $role->name }}
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('role-management.uppdate-permission', ['role' => $role->id]) }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role->id }}" />

                <table class="table caption-top">
                    <caption>List of Menu</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
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
                                @foreach($menu->MenuAction as $action)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="action_id[{{ $action->id }}]" name="action_id[]" value="{{ $action->id }}" @if($action->Acl->count() > 0) checked @endif>
                                    <label class="form-check-label" for="action_id[{{ $action->id }}]">{{ $action->name }}</label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>&nbsp; Submit
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
