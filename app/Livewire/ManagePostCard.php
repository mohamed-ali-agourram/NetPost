<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class ManagePostCard extends Component
{
    public Post $post;

    #[On("delete-post")]
    public function deletePost(string $data)
    {
        if ($data == $this->post->id) {
            $this->post->delete();
        }
    }

    public function render()
    {
        return view('components.posts.manage-post-card');
    }
}
