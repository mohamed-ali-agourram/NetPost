<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;

    public Post $post;

    public $is_published = "1";
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
            $this->is_published = $this->post->is_published;
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
        $data["is_published"] = $this->is_published;
        if ($this->is_published === "1") {
            $data["published_at"] = Carbon::now()->format('Y-m-d H:i:s');
        }
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
        if ($this->is_published === "1") {
            $data["is_published"] = $this->is_published;
            if ($this->post->published_at === null) {
                $data["published_at"] = Carbon::now()->format('Y-m-d H:i:s');
            }
        } elseif ($this->is_published === "0") {
            $data["is_published"] = $this->is_published;
            $data["published_at"] = null;
        }
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
