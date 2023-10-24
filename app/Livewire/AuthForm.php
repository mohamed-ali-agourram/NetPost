<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AuthForm extends Component
{
    public $is_register = false;
    #[Rule("required|min:3|max:15")]
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
        $user = User::create($validated);
        auth()->login($user);
        $this->redirectRoute("home", navigate: true);
    }

    public function render()
    {
        return view('livewire.auth-form');
    }
}
