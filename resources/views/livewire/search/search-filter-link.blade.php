<div wire:click='toggle_filter("{{ $filter_name }}", "{{ $search }}")'>
    <li class="{{ $filter === $filter_name ? 'active' : '' }}">
        @switch($filter_name)
            @case('users')
                <i class="fa-solid fa-users"></i>
            @break

            @case('posts')
                <i class="fa-solid fa-layer-group"></i>
            @break

            @default
                <i class="fa-solid fa-list"></i>
        @endswitch
        <span>{{ $filter_name }}</span>
    </li>
</div>
