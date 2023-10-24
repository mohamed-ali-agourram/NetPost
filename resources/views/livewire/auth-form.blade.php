<form wire:submit.prevent="{{$is_register ? 'register' : 'login' }}">
    <h2 class="logo gray">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <span>NETPOST</span>
    </h2>
    <div>
        <h1>{{ $is_register ? 'Register Now' : 'Welcome Back!' }}</h1>
        <p class="gray">{{ $is_register ? 'Lorem ipsum dolor sit amet' : 'Please login to your account' }}</p>
    </div>
    <div class="form_controller">
        @if ($is_register)
            <div>
                <label for="name">UserName</label>
                <input wire:model='name' type="text" id="name" name="name" placeholder="example">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        @endif
        <div>
            <label for="email">Email Adress</label>
            <input wire:model='email' type="" id="email" name="username" placeholder="example@gmail.com">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input wire:model='password' type="password" name="password" id="password" placeholder="********">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="test">
            {{ $is_register ? 'Create Account' : 'Login to NETPOST' }}
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
    @if ($is_register)
        <p class="gray form_footer">Alraedy have an account? <a wire:navigate href={{ route('auth.login') }}>Connect
                now</a></p>
    @else
        <p class="gray">Don't have an account yet? <a wire:navigate href="{{ route('auth.register') }}">Crete an
                acount</a></p>
    @endif
</form>
