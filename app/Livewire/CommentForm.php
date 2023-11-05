<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CommentForm extends Component
{
    public ?Post $post;
    #[Rule("required|max:5000")]
    public $body;
    public Comment $comment;

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

    #[On('update-comment')]
    public function trigger_update(Comment $comment)
    {
        $this->comment = $comment;
        $this->body = $this->comment->body;
    }

    public function update_comment()
    {
        $this->comment->update([
            "body" => $this->body
        ]);
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
