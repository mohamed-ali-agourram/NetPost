<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    #[On("new-post")]
    #[Computed()]
    public function posts()
    {
        return Post::published()->orderBy("published_at","desc")->get();
    }

    public function render()
    {
        return view('components.posts.posts-list');
    }
}
