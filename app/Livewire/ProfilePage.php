<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ProfilePage extends Component
{
    public $name;
    public $status;
    public $email;
    public $profile_image;

    #[On("update-profile")]
    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->status = auth()->user()->status;
        $this->email = auth()->user()->email;
        $this->profile_image = auth()->user()->profile_image();
    }

    #[Computed()]
    public function likes_count()
    {
        $count = 0;
        foreach (auth()->user()->posts as $post) {
            $count += $post->likes->count();
        }
        return $count;
    }

    public function render()
    {
        return view('livewire.profile-page');
    }
}
