<?php

namespace App\Livewire\Search;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class SearchPage extends Component
{
    public $search;

    public $filter;

    public function likes_count(User $user)
    {
        $count = 0;
        foreach ($user->posts as $post) {
            $count += $post->likes->count();
        }
        if ($count > 1) {
            return $count . ' likes';
        }
        return $count . ' like';
    }

    public function toggle_filter(string $filter)
    {
        $this->filter = $filter;
        dd($this->filter);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')->get();
        $posts = Post::where('body', 'like', '%' . $this->search . '%')->get();
        return view('livewire.search.search-page', ["users" => $users, "posts" => $posts]);
    }
}
