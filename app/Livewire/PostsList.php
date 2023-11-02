<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class PostsList extends Component
{

    #[On("like-post")]
    public function like(?Post $post)
    {
        if ($post === null) {
            return;
        }
        $user = auth()->user();

        $hasLiked = $user->has_liked($post);

        if ($hasLiked) {
            $user->likes()->detach($post);
            return;
        } else {
            $user->likes()->attach($post);
            return;
        }
    }

    #[On("new-post")]
    #[Computed()]
    public function posts()
    {
        return Post::published()->orderBy("published_at", "desc")->get();
    }

    public function render()
    {
        return view('components.posts.posts-list');
    }
}
