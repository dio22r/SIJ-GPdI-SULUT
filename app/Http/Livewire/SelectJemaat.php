<?php

namespace App\Http\Livewire;

use App\Models\MhJemaat;
use Livewire\Component;

class SelectJemaat extends Component
{

    public $text = "";
    public $idJemaat = null;
    public $idGereja = null;
    public $showDropdown = false;
    public $listJemaat = [];

    public function mount($idGereja)
    {
        $this->idGereja = $idGereja;
    }

    public function search()
    {
        if (strlen($this->text) < 3) {
            $this->listJemaat = [];
            $this->showDropdown = false;
        } else {
            $this->showDropdown = true;
            $this->listJemaat = MhJemaat::query()
                ->where("name", "like", "%" . $this->text . "%")
                ->where("mh_gereja_id", "=", $this->idGereja)
                ->where("status", ">", 0)
                ->orderBy("name", "asc")
                ->take(5)->get();
        }
    }

    public function pick($idJemaat, $nameJemaat)
    {
        $this->showDropdown = false;
        $this->idJemaat = $idJemaat;
        $this->text = $nameJemaat;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.select-jemaat');
    }
}
