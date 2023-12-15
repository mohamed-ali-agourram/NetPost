<?php

namespace App\Livewire\Search;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class SearchPage extends Component
{
    public $search;
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')->get();
        $posts = Post::where('body', 'like', '%' . $this->search . '%')->get();
        return view('livewire.search.search-page', ["users" => $users, "posts" => $posts]);
    }
}
