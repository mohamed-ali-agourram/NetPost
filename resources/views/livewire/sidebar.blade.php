<aside class="routes">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <p>NETPOST</p>
        </a>
        <i class="fa-solid fa-x"></i>
    </div>
    <ul class="nav">
        <form action="#.php">
            <label for="search"></label>
            <input type="text" name="search" placeholder="search" id="search">
        </form>
        <x-link route="home" icon="fa-house" />
        <x-link route="profile" icon="fa-user" />
        <x-link route="freinds" icon="fa-users" />
        <x-link route="settings.account" name="settings" icon="fa-gear" />
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
