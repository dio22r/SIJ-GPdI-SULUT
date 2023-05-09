<tr>
    <td>
        @if ($gereja->slug)
        <a href="{{ route('front.gereja.show', ['slug' => $gereja->slug]) }}">
            {{ $gereja->name }}
        </a>
        @else
        {{ $gereja->name }}
        @endif
    </td>
    <td>{{ $gereja->pastor_name }}</td>
    <td>{{ $gereja->MhWilayah ? $gereja->MhWilayah->code . " " . $gereja->MhWilayah->name : " - " }}</td>
</tr>