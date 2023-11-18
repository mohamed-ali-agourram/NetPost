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
    public $is_freindship = false;

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
        $this->is_freindship = $this->user->pendingRequests()->contains('id', auth()->user()->id) || $this->user->friends()->contains('id', auth()->user()->id);
    }

    #[Computed()]
    public function pendingRequest()
    {
        // return auth()->user()->pendingFriendRequests()
        //     ->where('sender', $this->user->id)
        //     ->orWhere('receiver', $this->user->id)
        //     ->first();
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
        $existingFriendship = $auth->friends()->contains("id", $this->user->id);

        if (!$existingFriendship && $auth->id !== $this->user->id) {
            if ($this->pendingRequest) {
                DB::table('friendships')
                    ->where('sender', $auth->id)
                    ->where('receiver', $this->user->id)
                    ->orWhere(function ($query) use ($auth) {
                        $query->where('sender', $this->user->id)
                            ->where('receiver', $auth->id);
                    })->delete();
                $this->mount();
            } else {
                $auth->friends()->attach($this->user->id, ['status' => 'pending']);
                $this->mount();
            }
        } else {
            dd("Already friends or invalid user.");
        }
    }

    public function handle_request(bool $status)
    {
        $authUser = auth()->user();
        $friendRequest = $this->pendingRequests()->contains("id", $authUser->id);

        if ($friendRequest) {
            if ($status) {
                DB::table('friendships')
                    ->where('sender', $friendRequest->pivot->sender)
                    ->where('receiver', $friendRequest->pivot->receiver)
                    ->update(['status' => 'accepted']);

                $this->mount();
            } else {
                DB::table('friendships')
                    ->where('sender', $friendRequest->pivot->sender)
                    ->where('receiver', $friendRequest->pivot->receiver)
                    ->orWhere(function ($query) use ($authUser, $friendRequest) {
                        $query->where('sender', $friendRequest->pivot->receiver)
                            ->where('receiver', $authUser->id);
                    })
                    ->delete();

                $this->mount();
            }
        }
    }

    public function freinds()
    {
        dd("FREINDS!");
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
