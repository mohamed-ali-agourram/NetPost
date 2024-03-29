<?php

namespace App\Livewire\Post;

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

    public $visibility = "friends";
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
            $this->visibility = $this->post->visibility;
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

    #[On("update-profile-image")]
    public function create(string $imagePath = null, string $coverImagePath = null)
    {
        $data = $this->validate();
        if ($imagePath != null || $coverImagePath != null) {
            $this->visibility = "friends";
        }
        $data["visibility"] = $this->visibility;
        if ($this->visibility === "public" || $this->visibility === "friends") {
            $data["published_at"] = Carbon::now()->format('Y-m-d H:i:s');
        }
        $data["user_id"] = auth()->id();
        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }
        if ($imagePath != null) {
            $data["is_profile_update"] = "1";
            $data["image"] = $imagePath;
        }
        if ($coverImagePath != null) {
            $data["is_cover_update"] = "1";
            $data["image"] = $coverImagePath;
        }
        Post::create($data);
        $this->dispatch("new-post");
        $this->reset();
        $this->is_open = false;
    }

    public function update()
    {
        $data = $this->validate([
            'body' => 'max:5000',
        ]);
        if ($this->visibility === "public" || $this->visibility === "friends") {
            $data["visibility"] = $this->visibility;
            if ($this->post->published_at === null) {
                $data["published_at"] = Carbon::now()->format('Y-m-d H:i:s');
            }
        } elseif ($this->visibility === "private") {
            $data["visibility"] = $this->visibility;
            $data["published_at"] = null;
        }
        if ($this->image && isset($this->shared_post) === false && method_exists($this->image, 'temporaryUrl')) {
            $data['image'] = $this->image->store('images', 'public');
        } else {
            $data['image'] = $this->image;
        }
        $this->post->update($data);
        $this->is_open = false;
        $this->dispatch("new-post");
    }

    public function render()
    {
        return view('components.posts.post-form');
    }
}
