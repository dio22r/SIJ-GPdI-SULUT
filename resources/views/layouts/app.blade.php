<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ url('/assets/vendor/fa/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'GPdI SULUT') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('front.wilayah.index') }}">Wilayah</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('front.gereja.index') }}">Gereja</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" target="_blank" href="https://gerejaku.gpdisulut.com/">Forum</a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard
                                </a>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> &nbsp; {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <style>
            #footer {
                padding: 50px 0px 100px 0px;
                color: #555;
            }

            #footer .social-btn {
                display: inline-flex;
            }

            #footer .box-content h5 {
                position: relative;
            }

            #footer .box-content h5::after {
                content: "";
                border-bottom: 2px solid #555;
                width: 50px;
                position: absolute;
                bottom: -6px;
                left: 0px;
            }

            #footer ul {
                padding: 0px;
            }

            #footer li {
                list-style: none;
                margin: 0px 0px;
            }

            #footer li a {
                color: #555;
                text-decoration: none;
            }

            #footer li a:hover {
                color: #aaa;
            }

            #copyright {
                background-color: #FB0000;
                padding: 10px 0px 10px 0px;
                border-bottom: 5px solid #FB0000;
                color: white;
                font-size: 12px;
                font-weight: 500;
            }
        </style>
        <section id="footer" class="shadow-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="{{ url('/') }}">
                                    <img class="me-2" style="max-width:100px" src="{{ url('/assets/img/logo-gpdi.png') }}" width="100%" />
                                </a>
                            </div>
                            <div class=" col-sm-9  box-content">
                                <h5 class="mb-3">Sistem Informasi Jemaat (SIJ)</h5>
                                <h3 class="mb-3">GPdI SULUT</h3>
                                <ul>
                                    <li class="mb-2">
                                        <a href="#">
                                            <i class="fas fa-map-marker-alt"></i>&nbsp;
                                            Ring Road 2, Buha, Kec. Mapanget, Kota Manado, Sulawesi Utara
                                        </a>
                                    </li>
                                    <!-- <li class="mb-2">
                                        <a href="#">
                                            <i class="fas fa-phone"></i>&nbsp;
                                            No. Telp: 085234029945
                                        </a>
                                    </li> -->
                                    <li class="mb-2">
                                        <a href="mailto:info.gpdisulut@gmail.com">
                                            <i class="far fa-envelope"></i>&nbsp;
                                            Email: info.gpdisulut@gmail.com
                                        </a>
                                    </li>
                                    <!-- <li class="mb-2">
                                        <a target="_blank" href="https://api.whatsapp.com/send?phone=6285234029945">
                                            <i class="fab fa-whatsapp"></i>&nbsp;
                                            Kontak Aduan: 085234029945
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-3 box-content">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11280.875540163823!2d124.8938951958465!3d1.5321934145257257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3287a04dc647d99b%3A0xf76fc0ae94811b1!2sPentecostal%20Center%20GPdI%20Sulut!5e0!3m2!1sid!2sid!4v1653020964403!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ url('/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
