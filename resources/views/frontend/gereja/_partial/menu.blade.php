<div class="card mb-3">
    <div class="list-group list-group-flush">
        <a href="{{ route('front.gereja.show', ['slug' => $gereja->slug]) }}" class="list-group-item list-group-item-action">Profile</a>
        <a href="{{ route('front.gereja.schedule', ['slug' => $gereja->slug]) }}" class="list-group-item list-group-item-action">Jadwal Ibadah</a>
        <!-- <a href="#" class="list-group-item list-group-item-action">Feed</a> -->
    </div>
</div>
