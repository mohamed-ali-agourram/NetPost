<?php

namespace App\Livewire\Search;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPage extends Component
{
    use WithPagination;
    public $n_posts = 4;
    public $loadingMorePosts = true;
    public $n_users = 4;
    public $loadingMoreUsers = true;
    public $search;
    public $filter;

    public function mount()
    {
        $this->filter = request()->query('filter');
    }

    public function toggle_filter(string $filter)
    {
        $this->filter = $filter;
        $this->redirectRoute("search", ['search' => $this->search, "filter" => $this->filter], navigate: true);
    }

    public function handleSubmit()
    {
        $this->validate([
            'search' => 'required|string|max:255',
        ]);

        $this->redirectRoute("search", ['search' => $this->search, "filter" => $this->filter], navigate: true);
    }

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

    public function load_more_posts()
    {
        $this->loadingMorePosts = true;
        $this->n_posts += 3;
        $this->loadingMorePosts = false;
    }

    public function load_more_users()
    {
        $this->loadingMoreUsers = true;
        $this->n_users += 3;
        $this->loadingMoreUsers = false;
    }

    public function render()
    {
        $users = collect();
        $posts = collect();

        if (!empty($this->search)) {
            $users = User::where('name', 'like', '%' . $this->search . '%')->paginate($this->n_users);
            $posts = Post::where('body', 'like', '%' . $this->search . '%')->paginate($this->n_posts);
        }
        return view('livewire.search.search-page', ["users" => $users, "posts" => $posts]);
    }
}
