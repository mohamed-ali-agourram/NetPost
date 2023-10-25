<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;

    public Post $post;

    #[Rule("required|min:2|max:250")]
    public $title;
    #[Rule("min:2|max:500")]
    public $body;
    #[Rule("nullable|sometimes|image|max:1024")]
    public $image;
    public $is_open = false;

    #[On("open-form")]
    public function toggleForm(string $post = null)
    {
        $this->is_open = true;
        if(isset($post))
        {
            $this->post = Post::find($post);
            $this->title = $this->post->title;
            $this->body = $this->post->body;
        }
    }

    #[On("close-form")]
    public function close()
    {
        $this->is_open = false;
    }

    public function create()
    {
        $data = $this->validate();
        $data["user_id"] = auth()->id();
        $data["slug"] = \Illuminate\Support\Str::slug($this->title);
        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }
        Post::create($data);
        $this->is_open = false;
        $this->dispatch("new-post");
        $this->reset();
    }

    public function update()
    {
        $this->post->update([
            "title"=> $this->title,
            "body"=> $this->body
        ]);
        $this->is_open = false;
    }

    public function render()
    {
        return view('components.posts.post-form');
    }
}
