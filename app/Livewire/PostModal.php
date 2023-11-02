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


    public function toggleLike()
    {
        $this->dispatch("new-post");

        $user = auth()->user();

        $hasLiked = $user->has_liked($this->post);

        if($hasLiked){
            $user->likes()->detach($this->post);
            return;
        }else{
            $user->likes()->attach($this->post);
            return;
        }
    }

    public function render()
    {
        return view('livewire.post-modal');
    }
}
