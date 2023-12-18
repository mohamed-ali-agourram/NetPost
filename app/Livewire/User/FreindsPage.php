<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class FreindsPage extends Component
{
    public $loadingMoreFriends = true;
    public $n_friends = 4;

    public function load_more_friends()
    {
        $this->loadingMoreFriends = true;
        $this->n_friends += 3;
        $this->loadingMoreFriends = false;
    }

    #[On("refresh-page")]
    #[Computed()]
    public function friends()
    {
        return auth()->user()->friends()->paginate($this->n_friends);
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
