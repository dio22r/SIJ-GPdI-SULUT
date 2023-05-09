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
        Wilayah {{ $gereja->MhWilayah->code }} {{ $gereja->MhWilayah->name }}
        @endif
        @endif

        <div>{{ $gereja->address }}</div>
    </div>

</div>
