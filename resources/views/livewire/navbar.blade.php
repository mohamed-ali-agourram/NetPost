<header id="navbar">
    <div class="toggleNav"

    >
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
            <div class="n_notif">5</div>
        </div>
        <a wire:navigate href="{{ route('profile') }}">
            <img src="{{ auth()->user()->profile_image() }}" alt="user_profile">
        </a>
    </div>
</header>
