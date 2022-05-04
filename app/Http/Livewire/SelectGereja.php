<?php

namespace App\Http\Livewire;

use App\Models\MhGereja;
use Livewire\Component;

class SelectGereja extends Component
{
    public $text = "";
    public $idGereja = null;

    public $showDropdown = false;
    public $listGereja = [];

    public function mount($gereja)
    {
        if ($gereja) {
            $this->idGereja = $gereja->id;
            $this->text = $gereja->name;
        }
    }

    public function search()
    {
        if (strlen($this->text) < 4) {
            $this->listGereja = [];
            $this->showDropdown = false;
        } else {
            $this->showDropdown = true;
            $this->listGereja = MhGereja::query()
                ->where("name", "like", "%" . $this->text . "%")
                ->orderBy("name", "asc")
                ->take(5)->get();
        }
    }

    public function pick($idGereja, $namaGereja)
    {
        $this->showDropdown = false;
        $this->idGereja = $idGereja;
        $this->text = $namaGereja;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.select-gereja');
    }
}
