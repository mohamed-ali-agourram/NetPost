<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PostForm extends Component
{
    #[Rule("required|min:2|max:250")]
    public $title;
    #[Rule("min:2|max:500")]
    public $body;
    public $is_open = false;

    #[On("form-toggle")]
    public function toggleForm(){
        $this->is_open = !$this->is_open;
    }

    public function create()
    {
        $data = $this->validate();
        $data["user_id"] = auth()->id();
        $data["slug"] = \Illuminate\Support\Str::slug($this->title);
        Post::create($data);
        $this->is_open = false;
        $this->dispatch("new-post");
        $this->reset();
    }

    public function render()
    {
        return view('components.posts.post-form');
    }
}
