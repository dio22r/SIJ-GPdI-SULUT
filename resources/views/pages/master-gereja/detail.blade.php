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
                            <a href="{{ route('master-gembala.detail', ['gembala' => $gereja->MhGembala->id]) }}">
                                {{ $gereja->MhGembala->name }}
                            </a>
                            @endif
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Wilayah</dt>
                        <dd class="col-sm-8">
                            @if ($gereja->MhWilayah)
                            <a href="{{ route('master-wilayah.detail', ['wilayah' => $gereja->MhWilayah->id]) }}">
                                {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
                            </a>
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
                            <button class="nav-link active" id="nav-user-tab" data-bs-toggle="tab" data-bs-target="#nav-user" type="button" role="tab" aria-controls="nav-user" aria-selected="true">User</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                            <button class="nav-link" id="nav-schedule-tab" data-bs-toggle="tab" data-bs-target="#nav-schedule" type="button" role="tab" aria-controls="nav-schedule" aria-selected="false">Jadwal</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                            <a href="{{ route('master-gereja.user.create', ['gereja' => $gereja->id]) }}" class="btn btn-sm btn-primary">
                                Tambah User
                            </a>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gereja->User as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $user->name }} <br />
                                            ({{ $user->email }})
                                        </td>
                                        <td>{{ $user->RoleMhGereja[0]->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('master-gereja.user.destroy', ['gereja' => $gereja->id, 'user' => $user->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('master-gereja.user.edit', ['gereja' => $gereja->id, 'user' => $user->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                                <button type="submit" class="btn btn-sm btn-danger ">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            {!! $gereja->profile !!}
                        </div>
                        <div class="tab-pane fade" id="nav-schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
                            <br />
                            {!! $gereja->schedule !!}
                        </div>
                    </div>
                </div>
            </div>


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
