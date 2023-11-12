<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ProfilePage extends Component
{
    public $profile_image;
    public $cover_image;

    #[On("update-profile")]
    public function mount()
    {
        $this->profile_image = auth()->user()->profile_image();
        $this->cover_image = auth()->user()->cover_image();
    }

    #[Computed()]
    public function likes_count()
    {
        $count = 0;
        foreach (auth()->user()->posts as $post) {
            $count += $post->likes->count();
        }
        if ($count > 1) {
            return $count . " likes";
        }
        return $count . " like";
    }

    #[On("new-post")]
    #[Computed()]
    public function posts()
    {
        return auth()->user()->posts->sortByDesc('created_at');
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
