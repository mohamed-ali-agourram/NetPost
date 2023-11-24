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
    <div class="explore">
        <p>Explore the NET</p>
        <a href="#"><i class="fa-solid fa-globe"></i>Community</a>
        <a href="#"><i class="fa-solid fa-users"></i>Freinds</a>
    </div>
    <div class="header__profile">
        <div class="bell">
            <i class="fa-solid fa-bell"></i>
            @php
                $notifications_count = auth()->user()->unreaded_notifications->count()
            @endphp
            @if ($notifications_count > 0)
                <div class="n_notif">{{ $notifications_count }}</div>
            @endif
        </div>
        <a wire:navigate href="{{ route('profile', ['slug' => auth()->user()->slug]) }}">
            <img src="{{ $this->authProfileImage }}" alt="user_profile">
        </a>
    </div>
</header>
