<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />


    <!-- Bootstrap CSS -->
    <link href="{{ url('/css/sb-admin/styles.css') }}" rel="stylesheet" />
    <link href="{{ url('/assets/vendor/fa/css/all.min.css') }}" rel="stylesheet">
    @yield('css')

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
</head>

<body>

    @include("panel.navbar")

    <div id="layoutSidenav">

        @include("panel.sidenav")

        <div id="layoutSidenav_content">
            <main class="mb-5">
                @yield('content')
            </main>
            <footer class="py-3 bg-bts-copyright bg-light bts-copyright mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-bts">Copyright &copy; {{ config('app.name', 'Laravel') }} {{ date('Y') }}</div>
                        <div class="text-bts">Supported by Jesus Christ My Savior</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="{{ url('/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ url('/js/sb-admin/scripts.js') }}"></script>
    <script src="{{ url('/js/axios.min.js') }}"></script>
    <script src="{{ url('/js/vue2.js') }}"></script>
    <script src="{{ url('/js/sweetalert2.11.js') }}"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->


    @yield('js')
</body>

</html>
