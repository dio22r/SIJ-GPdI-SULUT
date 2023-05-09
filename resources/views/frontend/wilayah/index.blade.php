@extends('layouts.app')

@section('content')

<section id="banner" class="bg-light py-5">
    <div class="container">

        <div class="display-4 mb-5 text-center">
            List Wilayah GPdI SULUT
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Wilayah</th>
                                <th>Kabupaten</th>
                                <th>Jumlah Gereja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listWilayah as $wilayah)
                            <tr>
                                <td>
                                    @if ($wilayah->slug)
                                    <a href="{{ route('front.wilayah.show', ['slug' => $wilayah->slug]) }}">
                                        {{ $wilayah->code }} {{ $wilayah->name }}
                                    </a>
                                    @else
                                    {{ $wilayah->code }} {{ $wilayah->name }}
                                    @endif
                                </td>
                                <td>{{ $wilayah->MhKabupaten->name }}</td>
                                <td>{{ $wilayah->temp_gereja_count }}</td>
                            </tr>
                            @endForeach
                        </tbody>
                    </table>

                    <div>
                        {{ $listWilayah->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection