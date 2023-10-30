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

    #[Rule("max:5000")]
    public $body;
    #[Rule("nullable|sometimes|image|max:5024")]
    public $image;
    public $is_open = false;
    public $isEditMode = false;

    #[On("open-form")]
    public function toggleForm(string $post = null)
    {
        $this->is_open = true;
        if (isset($post)) {
            $this->isEditMode = true;
            $this->post = Post::find($post);
            $this->body = $this->post->body;
            $this->image = null;
            if ($this->post->image) {
                $this->image = $this->post->image;
            }
        }
    }

    #[On("close-form")]
    public function close()
    {
        $this->is_open = false;
        $this->reset();
        $this->resetValidation();
    }

    public function resetImage()
    {
        $this->image = null;
    }

    public function create()
    {
        $data = $this->validate();
        $data["user_id"] = auth()->id();
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
        $data = $this->validate([
            'body' => 'max:5000',
        ]);
        if ($this->image && method_exists($this->image, 'temporaryUrl')) {
            $data['image'] = $this->image->store('images', 'public');
        } else {
            $data['image'] = $this->image;
        }
        $this->post->update($data);
        $this->is_open = false;
    }

    public function render()
    {
        return view('components.posts.post-form');
    }
}
