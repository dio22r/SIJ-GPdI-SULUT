<div class="dropdown">
    <input type="text" wire:model="text" wire:keydown="search" wire:blur="hideDropdown" class="form-control" id="nama_gereja" name="nama_gereja" value="">
    @if ($showDropdown)
    <ul class="dropdown-menu show" aria-labelledby="dropdownMenuButton1">
        @foreach($listGereja as $gereja)
        <li>
            <a wire:click.prevent="pick({{ $gereja->id }}, '{{ $gereja->name }}')" class="dropdown-item" href="#">
                {{ $gereja->name }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    <input type="hidden" name="mh_gereja_id" wire:model="idGereja" />
</div>
