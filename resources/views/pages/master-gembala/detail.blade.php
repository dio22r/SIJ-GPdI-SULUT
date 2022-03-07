@extends('layouts.admin')

@section('title', 'Detail Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Gereja
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Gereja</dt>
                <dd class="col-sm-10">
                    <h5>{{ $gereja->name }} </h5>
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Gembala</dt>
                <dd class="col-sm-10">
                    @if ($gereja->MhGembala)
                    <a href="{{ route('master-gembala.detail', ['gembala' => $gereja->MhGembala->id]) }}">
                        {{ $gereja->MhGembala->name }}
                    </a>
                    @endif
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Wilayah</dt>
                <dd class="col-sm-10">
                    @if ($gereja->MhWilayah)
                    <a href="{{ route('master-wilayah.detail', ['wilayah' => $gereja->MhWilayah->id]) }}">
                        {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
                    </a>
                    @endif
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Alamat</dt>
                <dd class="col-sm-10">
                    {{ $gereja->address }}
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Tanggal SK</dt>
                <dd class="col-sm-10">
                    {{ $gereja->date_birth }}
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Profil</dt>
                <dd class="col-sm-10">
                    {!! $gereja->profile !!}
                </dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Jadwal</dt>
                <div class="col-sm-10">
                    {!! $gereja->schedule !!}
                </div>
            </dl>
            <dl class="row">
                <dt class="col-sm-2">Lokasi</dt>
                <div class="col-sm-10">
                    @if($gereja->latitude && $gereja->longitude)
                    <div id="map" style="height:300px"></div>
                    @else
                    -
                    @endif
                </div>
            </dl>

            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
</div>


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
            zoom: 7,
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
