<div class="dropdown">
    <input type="text" wire:model="text" wire:keydown="search" wire:blur="hideDropdown" class="form-control" id="name_jemaat" name="name_jemaat" value="">
    @if ($showDropdown)
    <ul class="dropdown-menu show" aria-labelledby="dropdownMenuButton1">
        @foreach($listJemaat as $jemaat)
        <li>
            <a wire:click.prevent="pick({{ $jemaat->id }}, '{{ $jemaat->name }}')" class="dropdown-item" href="#">
                {{ $jemaat->name }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    <input type="hidden" name="id_jemaat" wire:model="idJemaat" />
</div>
