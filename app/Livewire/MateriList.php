<?php

namespace App\Livewire;

use App\Models\Mapel;
use App\Models\Materi;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MateriList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';
    #[Url()]
    public $search = '';
    #[Url()]
    public $mapel = '';

    #[On('search')]
    public function updateSearch($search){
        $this->search = $search;
    }

    public function clearFilters(){
        $this->mapel = '';
        $this->resetPage();
    }

    public function setSort($sort){
        $this->sort = ($sort == 'desc') ? 'desc' : 'asc';
    }

    #[Computed()]
    public function materi(){
        return Materi::published()
        ->where('title', 'like', "%{$this->search}%")
        ->when($this->activeMapel, function($query){
            $query ->Mapel($this->mapel);
        })
        ->orderBy('published_at', $this->sort)->paginate(5);

    }

    #[Computed()]
    public function activeMapel(){
        return Mapel::where('slug', $this->mapel)->first();
    }

    public function render()
    {
        return view('livewire.materi-list');
    }
}
