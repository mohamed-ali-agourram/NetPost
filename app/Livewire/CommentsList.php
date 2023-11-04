<?php

namespace App\Livewire;

use App\Models\Post;
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

    public function render()
    {
        return view('livewire.comments-list');
    }
}
