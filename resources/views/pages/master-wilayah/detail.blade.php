@extends('layouts.admin')

@section('title', 'Detail Wilayah')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Wilayah
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Wilayah</dt>
                <dd class="col-sm-10">
                    <h5>{{ $wilayah->code }} {{ $wilayah->name }} </h5>
                </dd>

                <dt class="col-sm-2">Kabupaten</dt>
                <dd class="col-sm-10">
                    {{ $wilayah->MhKabupaten->name }}
                </dd>
            </dl>

            <table class="table caption-top">
                <caption>List of Gereja</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gereja</th>
                        <th scope="col">Gembala</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wilayah->MhGereja as $gereja)
                    <tr>
                        <th scope="row"> {{ $loop->iteration }} </th>
                        <td>
                            <a href="{{ route('master-gereja.detail', ['gereja' => $gereja->id]) }}">
                                {{ $gereja->name }}
                            </a>
                        </td>
                        <td>{{ optional($gereja->MhGembala)->name }}</td>
                        <td>{{ $gereja->address }}</td>
                        <td>
                            <a href="{{ route('master-gereja.edit', ['gereja' => $gereja->id]) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


@endsection
