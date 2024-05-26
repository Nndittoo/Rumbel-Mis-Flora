<?php

namespace App\Livewire;

use App\Models\Materi;
use App\Models\Reply;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PostComments extends Component
{

    use WithPagination;
    public Materi $materi;

    #[Rule('required|min:3|max:250')]
    public string $comment;
    public $replyComment;
    public $replyingToCommentId = null;

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

    public function replyToComment($commentId)
    {
        $this->replyingToCommentId = $commentId;
    }

    public function postReply($commentId)
    {
        // Simpan balasan ke database
        Reply::create([
            'reply' => $this->replyComment,
            'comment_id' => $commentId,
            'user_id' => auth()->id(),
        ]);
        $this->replyComment = '';
    }
}
