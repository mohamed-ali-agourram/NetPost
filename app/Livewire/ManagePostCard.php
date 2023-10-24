<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ManagePostCard extends Component
{
    public Post $post;

    public function render()
    {
        return view('components.posts.manage-post-card');
    }
}
