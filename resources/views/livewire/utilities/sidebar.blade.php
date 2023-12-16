<aside class="routes">
    <div class="logo">
        <a wire:navigate href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <p>NETPOST</p>
        </a>
        <i class="fa-solid fa-x"></i>
    </div>
    <ul class="nav">
        <livewire:search.search-box />
        <div class="nav_routes">
            <x-link route="home" icon="fa-house" />
            <x-link route="profile" icon="fa-user" />
            <x-link route="freinds" icon="fa-users" />
            <x-link route="settings.account" name="settings" icon="fa-gear" />
        </div>
        <div class="search_routes">
            <div class="line"></div>
            <h3 class="underline">Filters</h3>
            @php
                $sections = app()->view->getSections();
                $filter = isset($sections['filter']) ? $sections['filter'] : null;
                $search = isset($sections['search']) ? $sections['search'] : null;
            @endphp
            <livewire:search.search-filter-link :$search :$filter filter_name="all" />
            <livewire:search.search-filter-link :$search :$filter filter_name="posts" />
            <livewire:search.search-filter-link :$search :$filter filter_name="users" />
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
