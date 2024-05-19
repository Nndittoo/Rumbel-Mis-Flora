<?php

namespace App\Livewire;

use App\Models\Mapel;
use Livewire\Component;

class MapelList extends Component
{
    public $mapels;

    public function mount()
    {
        $this->mapels = Mapel::all();
    }

    public function render()
    {
        return view('livewire.mapel-list');
    }
}
