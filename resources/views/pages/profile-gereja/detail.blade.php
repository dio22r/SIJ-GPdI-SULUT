@extends('layouts.admin')

@section('title', 'Detail Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Detail Gereja
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <dl class="row">
                        <dd class="col-sm-12">
                            <h5>{{ $gereja->name }} </h5>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Gembala</dt>
                        <dd class="col-sm-8">
                            @if ($gereja->MhGembala)
                            {{ $gereja->MhGembala->name }}
                            @endif
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Wilayah</dt>
                        <dd class="col-sm-8">
                            @if ($gereja->MhWilayah)
                            {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
                            @endif
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">
                            {{ $gereja->address }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Tanggal SK</dt>
                        <dd class="col-sm-8">
                            {{ $gereja->date_birth }}
                        </dd>
                    </dl>
                    <dl class="row">
                        <div class="col-sm-12">
                            <strong>Lokasi</strong>
                            @if($gereja->latitude && $gereja->longitude)
                            <div id="map" style="height:300px"></div>
                            @else
                            -
                            @endif
                        </div>
                    </dl>
                </div>
                <div class="col-sm-6">
                    <nav class="mb-3">
                        <div class=" nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</button>
                            <button class="nav-link" id="nav-schedule-tab" data-bs-toggle="tab" data-bs-target="#nav-schedule" type="button" role="tab" aria-controls="nav-schedule" aria-selected="false">Jadwal</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            {!! $gereja->profile !!}
                        </div>
                        <div class="tab-pane fade" id="nav-schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
                            <br />
                            {!! $gereja->schedule !!}
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('profile-gereja.edit') }}" class="btn btn-warning">Edit</a>
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
