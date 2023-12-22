<?php

namespace App\Livewire\Comment;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Livewire\Attributes\Rule;

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
        if ($this->post->author->id !== auth()->user()->id) {
            Notification::create([
                'sender' => auth()->user()->id,
                'receiver' => $this->post->author->id,
                'type' => 'POST-REACTION',
                'body' => 'commented your post'
            ]);
        }
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
        return view('livewire.comment.comment-form');
    }
}
