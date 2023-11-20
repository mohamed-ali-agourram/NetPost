<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class FreindsPage extends Component
{
    public $friends;

    #[On("refresh-page")]
    public function mount()
    {
        $this->friends = auth()->user()->friends;
    }

    #[On("unfriend")]
    public function unfriend(User $user)
    {
        $friendship = auth()->user()->findFriendshipWith($user);
        DB::table('friendships')
            ->where('user_id', $friendship->user_id)
            ->where('friend_id', $friendship->friend_id)
            ->delete();
        $this->dispatch("refresh-page");
    }

    public function render()
    {
        return view('livewire.user.freinds-page');
    }
}
