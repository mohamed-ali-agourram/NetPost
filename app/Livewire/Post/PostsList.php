<?php

namespace App\Livewire\Post;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    public $is_friend_page;
    public $posts_per_page = 3;
    public $loadingMore = true;
    public $is_bottom = false;

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

    #[On("delete-post")]
    public function deletePost(string $data)
    {
        $post = Post::find($data);
        if ($post) {
            $post->delete();
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
        if ($this->is_friend_page) {
            $friendsPostsQuery = auth()->user()->friendsPosts();
            $this->is_bottom = $this->posts_per_page >= $friendsPostsQuery->count();
            return $friendsPostsQuery;
        } else {
            $publishedPostsQuery = Post::public()->orderBy("published_at", "desc");
            $this->is_bottom = $this->posts_per_page >= $publishedPostsQuery->count();
            return $publishedPostsQuery->paginate($this->posts_per_page);
        }
    }


    public function render()
    {
        return view('components.posts.posts-list');
    }
}
