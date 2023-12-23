<header id="navbar">
    <div class="toggleNav">
        <i class="fa-solid fa-bars"></i>
    </div>
    <a wire:navigate href="{{ route('home') }}" style="display: none;">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <p>NETPOST</p>
    </a>
    <div class="route">
        <a wire:navigate href="{{ route('home') }}" class="mobile_a">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
    </div>
    <style>
        .is_active {
            background-color: rgba(0, 0, 0, 0.589) !important;
        }
    </style>
    <div class="explore">
        <p>Explore the NET</p>
        <a @class(['is_active' => $route === 'home']) wire:navigate href="{{ route('home') }}"><i
                class="fa-solid fa-globe"></i>Freinds</a>
        <a @class(['is_active' => $route === 'freinds-posts']) wire:navigate href="{{ route('freinds-posts') }}"><i
                class="fa-solid fa-users"></i>Community</a>
    </div>
    <div class="header__profile">
        <div wire:poll.5s class="bell">
            @php
                $notifications_count = auth()
                    ->user()
                    ->unreaded_notifications->count();
            @endphp
            <i class="fa-solid fa-bell"></i>
            @if ($notifications_count > 0)
                <div class="n_notif">{{ $notifications_count }}</div>
            @endif
        </div>
        <a wire:navigate href="{{ route('profile', ['slug' => auth()->user()->slug]) }}">
            <img src="{{ $this->authProfileImage }}" alt="user_profile">
        </a>
    </div>
</header>
