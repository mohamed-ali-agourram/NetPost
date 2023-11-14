@props(['filter', 'sort_value'])
@if ($filter === 'likes' || $filter === 'comments')
    <button wire:click='toggleSort("{{ $filter }}")' class={{ $sort_value === 'desc' ? 'clicked' : '' }}><i
            class="fa-solid fa-clock"></i>Sort
        by {{ $filter }}</button>
@else
    <button wire:click='toggleSort("{{ $filter }}")' class={{ $sort_value !== 'desc' ? 'clicked' : '' }}><i
            class="fa-solid fa-clock"></i>Sort
        by {{ $filter }}</button>
@endif
