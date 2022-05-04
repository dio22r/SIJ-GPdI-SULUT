<?php

namespace App\Http\Livewire;

use App\Models\MhGembala;
use Livewire\Component;

class SelectGembala extends Component
{
    public $text = "";
    public $idGembala = null;

    public $showDropdown = false;
    public $listGembala = [];

    public function mount($gembala)
    {
        if ($gembala) {
            $this->idGembala = $gembala->id;
            $this->text = $gembala->name;
        }
    }

    public function search()
    {
        if (strlen($this->text) < 4) {
            $this->listGembala = [];
            $this->showDropdown = false;
        } else {
            $this->showDropdown = true;
            $this->listGembala = MhGembala::query()
                ->where("name", "like", "%" . $this->text . "%")
                ->orderBy("name", "asc")
                ->take(5)->get();
        }
    }

    public function pick($idGembala, $namaGembala)
    {
        $this->showDropdown = false;
        $this->idGembala = $idGembala;
        $this->text = $namaGembala;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.select-gembala');
    }
}
