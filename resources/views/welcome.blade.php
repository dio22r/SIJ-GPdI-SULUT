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

<style>
    .feature-icon {
        font-size: 3em;
        color: #777;
    }

    .feature-wraper {
        border: 1px solid #ccc;
    }
</style>
<section id="feature">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 align-item-center py-5">
                <div class="feature-icon text-center">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <span class="feature-title">STATISTIK JEMAAT</span>
            </div>
            <div class="col-md-3 col-6  py-5">
                <div class="feature-icon text-center">
                    <i class="fas fa-gift"></i>
                </div>
                <span>HUT SEPEKAN</span>
            </div>
            <div class="col-md-3 col-6  py-5">
                <div class="feature-icon text-center">
                    <i class="fas fa-database"></i>
                </div>
                <span>DATA TERPUSAT</span>
            </div>
            <div class="col-md-3 col-6  py-5">
                <div class="feature-icon text-center">
                    <i class="far fa-bell"></i>
                </div>
                <span>NOTIFIKASI HUT</span>
            </div>
        </div>
    </div>
</section>
@endsection
