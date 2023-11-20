<?php

namespace App\Livewire\Comment;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class CommentsList extends Component
{
    public ?Post $post;

    #[On("new-comment")]
    #[Computed()]
    public function comments(){
        return $this->post ? $this->post->comments->sortByDesc('created_at')->values()->all() : [];
    }

    #[On("delete-comment")]
    public function delete(Comment $comment)
    {
        $userId = auth()->user()->id;
        if($userId === $comment->author->id)
        {
            $comment->delete();
            $this->dispatch('refreshComponent');
            $this->dispatch("new-comment");
            $this->dispatch("new-post");
        }
    }

    public function render()
    {
        return view('livewire.comments-list');
    }
}
