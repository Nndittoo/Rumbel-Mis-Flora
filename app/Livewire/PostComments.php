<?php

namespace App\Livewire;

use App\Models\Materi;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PostComments extends Component
{

    public Materi $materi;

    #[Rule('required|min:3|max:250')]
    public string $comment;

    public function postComment(){
        $this->validateOnly('comment');

        $this->materi->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id()
        ]);

        $this->reset('comment');
    }

    #[Computed()]
    public function comments(){
        return $this?->materi?->comments()->latest()->get();
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
