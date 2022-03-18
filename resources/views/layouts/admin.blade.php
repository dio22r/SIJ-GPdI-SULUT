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

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "91356bb4-6683-4356-bdb7-f825b6cf5eb2",
            });

            OneSignal.isPushNotificationsEnabled().then(function(isEnabled) {
                if (isEnabled)
                    console.log("Push notifications are enabled!");
                else
                    console.log("Push notifications are not enabled yet.");
            });
        });

        window.onload = function() {
            OneSignal.push(function() {
                OneSignal.getUserId().then(function(userId) {

                    axios.post('{{ route("onesignal.subscribe") }}', {
                            uid: userId,
                            device: navigator.platform,
                            _token: "{{ csrf_token() }}"
                        })
                        .then(function(response) {
                            console.log(response);
                        })
                        .catch(function(error) {
                            console.log(error);
                        });

                    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
                });
            });
        };
    </script>

    <style>
        .bg-navbar {
            background: rgb(199, 23, 47);
            background: linear-gradient(90deg, rgba(199, 23, 47, 1) 0%, rgba(91, 75, 237, 1) 100%);
            border-bottom: 2px solid yellow;
            /* background-image: linear-gradient(90deg, #1b29d1, #8e00bf, #c400a8, #e8008f, #ff0077); */
        }
    </style>
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
