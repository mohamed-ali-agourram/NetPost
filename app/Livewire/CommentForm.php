<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CommentForm extends Component
{
    public ?Post $post;
    #[Rule("required|max:5000")]
    public $body;

    public function post_comment()
    {
        $validated = $this->validate();
        $validated["user_id"] = auth()->user()->id;
        $validated["post_id"] = $this->post?->id;
        Comment::create($validated);
        $this->reset("body");
        $this->dispatch("new-comment");
        $this->dispatch("new-post");
        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
