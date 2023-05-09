@extends('layouts.app')

@section('content')

<section id="banner" class="bg-light py-5">
    <div class="container">

        <div class="display-5 mb-5 text-center">
            Selamat Datang di Wilayah {{ $wilayah->code }} {{ $wilayah->name }}
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-3">
                    <a href="{{ route('front.wilayah.index') }}" class="btn btn-dark">
                        <i class="fas fa-chevron-left"></i> &nbsp; List Wilayah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!-- <th scope="col" class="text-center">No.</th> -->
                                <th scope="col">Gereja</th>
                                <th scope="col">Gembala</th>
                                <th scope="col">Wilayah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @each('frontend._partial.itemgereja', $listGereja, 'gereja')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
