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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Jadwal Sepekan
                        </h5>
                        {!! $gereja->schedule !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card mb-3">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">Profile</a>
                        <a href="#" class="list-group-item list-group-item-action">Jadwal Sepekan</a>
                        <!-- <a href="#" class="list-group-item list-group-item-action">Feed</a> -->
                    </div>
                </div>

                <div class="card">
                    @if($gereja->latitude && $gereja->longitude)
                    <div id="map" style="height:300px"></div>
                    @endif
                    <div class="card-body">

                        @if ($gereja->MhWilayah)
                        @if ($gereja->MhWilayah->slug)
                        <h5 class="card-title">
                            <a href="{{ route('front.wilayah.show', ['slug' => $gereja->MhWilayah->slug]) }}">
                                Wilayah {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
                            </a>
                        </h5>
                        @else
                        {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
                        @endif
                        @endif

                        <div>{{ $gereja->address }}</div>
                    </div>

                </div>

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
