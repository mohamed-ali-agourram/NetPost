<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class PostModal extends Component
{
    public $is_open = false;
    public Post $post;

    #[On("open-post-modal")]
    public function openModal(Post $post)
    {
        $this->post = Post::find($post->id);
        $this->is_open = true;
    }

    #[On("close-modal")]
    public function closeModal()
    {
        $this->is_open = false;
    }

    public function render()
    {
        return view('livewire.post-modal');
    }
}
