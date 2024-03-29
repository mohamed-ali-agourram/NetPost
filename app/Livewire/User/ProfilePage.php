<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

class ProfilePage extends Component
{
    use WithPagination;

    public $posts_per_page = 5;
    public $loadingMore = true;
    public $is_bottom = false;
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
        $this->is_freindship = $this->user->pendingRequests->contains('id', auth()->user()->id) || $this->user->friends->contains('id', auth()->user()->id);
    }

    #[On("delete-post")]
    public function deletePost(string $data)
    {
        $post = Post::find($data);
        if ($post) {
            $post->delete();
            $this->dispatch("new-post");
        }
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
        if ($post !== null) {
            $user = auth()->user();
            $hasLiked = $user->has_liked($post);
            if ($hasLiked) {
                $user->likes()->detach($post);
            } else {
                $user->likes()->attach($post);
                if ($post->author->id !== auth()->user()->id) {
                    Notification::create([
                        'sender' => auth()->user()->id,
                        'receiver' => $post->author->id,
                        'type' => 'POST-REACTION',
                        'body' => 'liked your post'
                    ]);
                }
            }
        }
    }

    #[On("share-post")]
    public function share(?Post $post, ?Post $sharedpost)
    {
        if ($post !== null) {
            $user = auth()->user();
            $shared_post_id = $sharedpost->id;
            $data = [
                "user_id" => $user->id,
                "visibility" => "friends",
                "published_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "shared_post" => $shared_post_id,
            ];
            Post::create($data);
            $post->shared = $post->shared + 1;
            $post->save();
            if ($post->author->id !== auth()->user()->id) {
                Notification::create([
                    'sender' => auth()->user()->id,
                    'receiver' => $post->author->id,
                    'type' => 'POST-REACTION',
                    'body' => 'shared your post'
                ]);
            }
            $this->dispatch("new-post");
        }
    }

    public function load_more()
    {
        $this->loadingMore = true;
        $this->posts_per_page += 5;
        $this->loadingMore = false;
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
        if ($this->user->id === auth()->user()->id) {
            $this->is_bottom = $this->posts_per_page >= $this->user->posts->count();
            return $posts->orderBy('created_at', $this->sort_date)->paginate($this->posts_per_page);
        } else {
            $this->is_bottom = $this->posts_per_page >= Post::where('user_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('visibility', 'public')
                        ->orWhere('visibility', 'friends');
                })->count();

            return $posts->where('user_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('visibility', 'public')
                        ->orWhere('visibility', 'friends');
                })
                ->orderBy('created_at', $this->sort_date)
                ->paginate($this->posts_per_page);
        }
    }

    public function add_friend()
    {
        $auth = auth()->user();
        $existingFriendship = $auth->friends->contains("id", $this->user->id);
        $existingFriendshipRequest = $auth->pendingRequests->contains("id", $this->user->id);

        if (!$existingFriendship && !$existingFriendshipRequest && $auth->id !== $this->user->id) {
            $auth->friendsTo()->attach($this->user->id, ['accepted' => 0]);
            Notification::create([
                'sender' => auth()->user()->id,
                'receiver' => $this->user->id,
                'type' => 'FRIENDSHIP-REQUEST',
                'body' => 'send you a friend request'
            ]);
        } else {
            $auth->pendingRequestsRelation()->detach($this->user->id);
        }
        $this->mount();
    }


    public function handle_request(bool $status)
    {
        $authUser = auth()->user();
        $friendRequest = $this->user->pendingRequests->contains("id", $authUser->id);

        if ($friendRequest) {
            $friendship = $this->user->findFriendshipWith($authUser);
            if ($status) {
                if (!$friendship || $friendship->accepted == 0) {
                    $this->user->friendsTo()->updateExistingPivot($authUser->id, ['accepted' => 1]);
                    Notification::create([
                        'sender' => auth()->user()->id,
                        'receiver' => $this->user->id,
                        'type' => 'FRIENDSHIP-REQUEST',
                        'body' => 'accepted your friend request'
                    ]);
                }
            } else {
                $this->user->pendingRequestsRelation()->detach($authUser->id);
                $this->dispatch("update-profile");
            }
            $this->mount();
        }
    }

    #[On("unfriend")]
    public function unfriend(User $user)
    {
        $friendship = auth()->user()->findFriendshipWith($user);
        DB::table('friendships')
            ->where('user_id', $friendship->user_id)
            ->where('friend_id', $friendship->friend_id)
            ->delete();
        $this->dispatch("update-profile");
    }

    public function render()
    {
        return view('livewire.user.profile-page');
    }
}
