<aside class="routes">
    <div class="logo">
        <a wire:navigate href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <p>NETPOST</p>
        </a>
        <i class="fa-solid fa-x"></i>
    </div>
    <ul class="nav">
        <form action="{{ route('search') }}">
            <label for="search"></label>
            <input type="text" name="search" placeholder="search" id="search">
        </form>
        <div class="nav_routes">
            <x-link route="home" icon="fa-house" />
            <x-link route="profile" icon="fa-user" />
            <x-link route="freinds" icon="fa-users" />
            <x-link route="settings.account" name="settings" icon="fa-gear" />
        </div>
        <div class="search_routes">
            <div class="line"></div>
            <h3 class="underline">Filters</h3>
            <a href="/">
                <li class="active">
                    <i class="fa-solid fa-list"></i>
                    <span>All</span>
                </li>
            </a>
            <a href="./profie.html">
                <li>
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Posts</span>
                </li>
            </a>
            <a href="./freinds.html">
                <li>
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </li>
            </a>
        </div>
    </ul>
    <div wire:click='logout' class="logout">
        <a href="#">
            <div>
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </div>
        </a>
    </div>

</aside>
