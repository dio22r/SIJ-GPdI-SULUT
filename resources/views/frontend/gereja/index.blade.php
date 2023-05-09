@extends('layouts.app')

@section('content')

<section id="banner" class="bg-light py-5">
    <div class="container">

        <div class="display-4 mb-5 text-center">
            List Gereja GPdI SULUT
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <form method="GET">
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Cari Nama Gereja" value="{{ $search }}">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Gereja</th>
                                <th>Gembala</th>
                                <th>Wilayah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @each("frontend._partial.itemgereja", $listGereja, "gereja")
                        </tbody>
                    </table>

                </div>
                <div class="table-responsive">
                    {{ $listGereja->links() }}
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
