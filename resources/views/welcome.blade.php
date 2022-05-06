@extends('layouts.app')

@section('content')


<section id="banner" class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <div class="text-center">
                    <img class="d-inline d-md-none mb-4" width="100px" src="{{ url('assets/img/logo-gpdi.png') }}" />
                </div>
                <h1 class="h4">MD GPdI SULUT!</h1>
                <div class="display-5 mb-2">
                    Sistem Informasi Jemaat
                </div>
                <p class="lead mb-5">
                    Aplikasi dari MD GPdI SULUT untuk membantu gembala dan jemaat dalam mengelolah data jemaat, data gereja, data gembala.
                    Yang dapat diakses dari mana saja, dengan perangkat apa saja.
                </p>
                <figure>
                    <figcaption class="blockquote-footer">
                        Hubungi Sekretariat MD GPdI SULUT untuk mendapatkan akses aplikasi.
                    </figcaption>
                </figure>
            </div>
            <div class="col-md-6 text-center">
                <img class="d-none d-md-inline" src="{{ url('assets/img/logo-gpdi.png') }}" />
            </div>
        </div>
    </div>
</section>

<section id="statistik">
    <div> </div>
</section>

<section id="feature">

</section>
@endsection
