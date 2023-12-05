<?php

namespace App\Livewire\Post;

use App\Models\Notification;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class PostsList extends Component
{

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
                if($post->author->id !== auth()->user()->id)
                {
                    Notification::create([
                        'sender' => auth()->user()->id,
                        'reciver' => $post->author->id,
                        'type' => 'POST-REACTION',
                        'body' => 'liked your post'
                    ]);
                }
            }
        }
    }

    #[On("share-post")]
    public function share(?Post $post)
    {
        if ($post !== null) {
            $user = auth()->user();
            $shared_post_id = $post->id;
            dd($shared_post_id);
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
