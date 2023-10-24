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
        return Post::orderBy("created_at","desc")->paginate(3);
    }

    public function render()
    {
        return view('components.posts.posts-list');
    }
}
