<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;

class AuthForm extends Component
{
    public $is_register = false;
    #[Rule("required|min:3|max:15|unique:users,name")]
    public $name;
    #[Rule("required|email|unique:users,email")]
    public $email;
    #[Rule("required|min:3|max:25")]
    public $password;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:25',
        ]);
        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();
            $this->reset();
            $this->redirectRoute("home", navigate: true);
        } else {
            $this->addError('email', 'invalid credentials');
            $this->reset("password");
        }
    }

    public function register()
    {
        $validated = $this->validate();
        $validated["slug"] = Str::slug($this->name);
        $user = User::create($validated);
        $user->configuration()->create();
        auth()->login($user);
        $this->redirectRoute("home", navigate: true);
    }

    public function render()
    {
        return view('livewire.user.auth-form');
    }
}
