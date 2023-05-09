@extends('layouts.admin')

@section('title', 'Form Gereja')

@section('content')


<div class="container my-3">
    <div class="card">
        <div class="card-header">
            Form Gereja
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action_url }}">
                @csrf
                @method($method)
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $gereja->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $gereja->address }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="date_birth" class="col-sm-2 col-form-label">Tanggal SK</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('date_birth') is-invalid @enderror" id="date_birth" name="date_birth" value="{{ $gereja->date_birth }}">
                        @error('date_birth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="profile" class="col-sm-2 col-form-label">Profil</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="tinymce form-control @error('profile') is-invalid @enderror" id="profile" name="profile">{{ $gereja->profile }}</textarea>
                        @error('profile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="schedule" class="col-sm-2 col-form-label">Jadwal ibadah</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="tinymce form-control @error('schedule') is-invalid @enderror" id="schedule" name="schedule">{{ $gereja->schedule }}</textarea>
                        @error('schedule')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mh_wilayah_id" class="col-sm-2 col-form-label">Wilayah</label>
                    <div class="col-sm-5">
                        <select class="form-select" name="mh_wilayah_id" id="mh_wilayah_id" aria-label="Default" disabled>
                            @foreach($arrWilayah as $wilayah)
                            <option value="{{ $wilayah->id }}" @if($wilayah->id == $gereja->mh_wilayah_id) selected @endif>
                                {{ $wilayah->code }} {{ $wilayah->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('mh_wilayah_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mh_gembala_nama" class="col-sm-2 col-form-label">Gembala</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('mh_gembala_nama') is-invalid @enderror" id="mh_gembala_nama" name="mh_gembala_nama" value="{{ $gereja->mh_gembala_nama }}">
                        @error('mh_gembala_nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="koordinat" class="col-sm-2 col-form-label">Koordinat</label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ $gereja->latitude }}">
                        @error('latitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Longitude" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ $gereja->longitude }}">
                        @error('longitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div id="map" style="height:300px"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="{{ route('profile-gereja.detail') }}" class="btn btn-sm btn-light">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section("js")
<script src="https://cdn.tiny.cloud/1/lpvzaq0rzbkg7bnqy10wvlse1hxnz24d38s2vs2hfljxpggx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&v=weekly" async></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        plugins: 'lists link image imagetools ',
        toolbar: 'undo redo | styleselect | bold italic | numlist bullist | link image',
        height: 300
    });

    function initMap() {
        let myLatlng = {
            lat: 1.480483855024048,
            lng: 124.85925709190631
        };

        let lat = document.getElementById("latitude").value;
        let lng = document.getElementById("longitude").value;

        if (lat && lng) {
            myLatlng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };
        }

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: myLatlng,
        });
        // Create the initial InfoWindow.
        let marker = new google.maps.Marker({
            title: "Click the map to get Lat/Lng!",
            map,
            position: myLatlng,
        });

        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.

            marker.setMap(null);

            // Create a new InfoWindow.
            marker = new google.maps.Marker({
                position: mapsMouseEvent.latLng,
                title: "Click the map to get Lat/Lng!",
                map,
            });

            let latLng = mapsMouseEvent.latLng.toJSON();

            document.getElementById("latitude").value = latLng.lat;
            document.getElementById("longitude").value = latLng.lng;

        });
    }
</script>
@endsection
