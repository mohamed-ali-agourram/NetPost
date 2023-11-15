<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProfilePage extends Component
{
    public User $user;
    public $profile_image;
    public $cover_image;
    #[Url()]
    public $sort_date = "desc";
    #[Url()]
    public $sort_likes = "";
    #[Url()]
    public $sort_comments = "";

    public function toggleSort($filter)
    {
        switch ($filter) {
            case 'date':
                $this->sort_date = $this->sort_date === 'desc' ? 'asc' : 'desc';
                break;
            case 'likes':
                $this->sort_likes = $this->sort_likes === 'asc' || $this->sort_likes === '' ? 'desc' : 'asc';
                break;
            case 'comments':
                $this->sort_comments = $this->sort_comments === 'asc' || $this->sort_comments === '' ? 'desc' : 'asc';
                break;
        }
    }



    #[On("update-profile")]
    public function mount()
    {
        $this->profile_image = $this->user->profile_image();
        $this->cover_image = $this->user->cover_image();

    }

    #[On("freind-request")]
    #[Computed()]
    public function pendingRequest()
    {
        return auth()->user()->pendingFriendRequests()
            ->where('sender', $this->user->id)
            ->orWhere('receiver', $this->user->id)
            ->first();
    }

    #[Computed()]
    public function likes_count()
    {
        $count = 0;
        foreach ($this->user->posts as $post) {
            $count += $post->likes->count();
        }
        if ($count > 1) {
            return $count . " likes";
        }
        return $count . " like";
    }

    #[On("like-post")]
    public function like(?Post $post)
    {
        if ($post === null) {
            return;
        }
        $user = $this->user;

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
        $posts = $this->user->posts();

        if ($this->sort_likes) {
            $posts = $posts
                ->withCount('likes')
                ->orderBy('likes_count', $this->sort_likes)
            ;
        }
        if ($this->sort_comments) {
            $posts = $posts
                ->withCount('comments')
                ->orderBy('comments_count', $this->sort_comments)
            ;
        }
        return $posts->orderBy('created_at', $this->sort_date)->get();
    }

    public function add_friend()
    {
        $auth = auth()->user();
        $existingFriendship = $auth->friends()->where('users.id', $this->user->id)->exists();

        if (!$existingFriendship && $auth->id !== $this->user->id) {
            if ($this->pendingRequest) {
                DB::table('friendship')
                    ->where('sender', $auth->id)
                    ->where('receiver', $this->user->id)
                    ->orWhere(function ($query) use ($auth) {
                        $query->where('sender', $this->user->id)
                            ->where('receiver', $auth->id);
                    })->delete();
                $this->dispatch("freind-request");
            } else {
                $auth->friends()->attach($this->user->id, ['status' => 'pending']);
                $this->dispatch("freind-request");
            }
        } else {
            dd("Already friends or invalid user.");
        }
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
