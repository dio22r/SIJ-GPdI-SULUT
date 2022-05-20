@extends('layouts.app')

@section('content')

<section id="banner" class="bg-light py-5">
    <div class="container">

        <div class="display-5 mb-5 text-center">
            Selamat Datang di {{ $gereja->name }}
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-3">
                    <a href="{{ route('front.gereja.index') }}" class="btn btn-dark">
                        <i class="fas fa-chevron-left"></i> &nbsp; List Gereja
                    </a>
                    <a href="{{ route('front.gereja.index') }}" class="btn btn-dark">
                        <i class="fas fa-chevron-left"></i> &nbsp; Wilayah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
