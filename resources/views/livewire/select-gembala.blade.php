<div class="dropdown">
    <input type="text" wire:model="text" wire:keydown="search" wire:blur="hideDropdown" class="form-control" id="sk_no" name="sk_no" value="">
    @if ($showDropdown)
    <ul class="dropdown-menu show" aria-labelledby="dropdownMenuButton1">
        @foreach($listGembala as $gembala)
        <li>
            <a wire:click.prevent="pick({{ $gembala->id }}, '{{ $gembala->name }}')" class="dropdown-item" href="#">
                {{ $gembala->name }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    <input type="hidden" name="mh_gembala_id" wire:model="idGembala" />
</div>
