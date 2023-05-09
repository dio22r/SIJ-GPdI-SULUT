@extends('layouts.app')

@section('content')

<section id="banner" class="bg-light py-5">
    <div class="container">

        <div class="display-5 mb-2 text-center">
            Selamat Datang di {{ $gereja->name }}
        </div>

        @if ($gereja->MhGembala)
        <h4 class="mb-5 text-center">
            Gembala: {{ $gereja->MhGembala->name }}
        </h4>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            Profil Gereja
                        </h5>
                        {!! $gereja->profile !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include("frontend.gereja._partial.menu", ["gereja" => $gereja])

                @include("frontend.gereja._partial.address-box", ["gereja" => $gereja])
            </div>
        </div>

    </div>
</section>

@endsection


@section("js")

<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&v=weekly" async></script>
<script>
    function initMap() {
        let gereja = @json($gereja);
        myLatlng = {
            lat: parseFloat(gereja.latitude),
            lng: parseFloat(gereja.longitude)
        };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatlng,
        });
        // Create the initial InfoWindow.
        let marker = new google.maps.Marker({
            title: gereja.name,
            map,
            position: myLatlng,
        });

    }
</script>
@endsection
