<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class AccountSettings extends Component
{
    public $name;
    public $status;
    public $email;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->status = auth()->user()->status;
        $this->email = auth()->user()->email;
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

    public function update_field(string $field_name)
    {
        $validated = $this->validate([
            $field_name => "required|min:3|max:30"
        ]);
        $user = Auth::user();
        $user[$field_name] = $validated[$field_name];
        $user->save();
        $this->resetValidation();
    }

    #[On("delete-account")]
    public function delete_account()
    {
        $user = Auth::user();
        $user->delete();
        $this->redirectRoute("auth.login", navigate: true);
    }

    public function render()
    {
        return view('livewire.settings.account-settings');
    }
}
