@props(['user', 'is_friendpage' => false, 'friend' => null])
@php
    $auth = auth()->user();
@endphp
<style>
    .a {
        display: flex;
        justify-content: center;
    }
</style>
@if ($user->id === $auth->id)
    <button class="user-card-btn">
        <a class="a" wire:navigate href="{{ route('profile', ['slug' => $auth->slug]) }}">
            <span>Show Profile</span>
            <i style="display: none" class="fa-solid fa-user"></i>
        </a>
    </button>
@else
    @php
        $is_freindship = $auth
            ->friends()
            ->where('id', $user->id)
            ->exists();
    @endphp
    @if ($is_freindship)
        @if ($is_friendpage)
            <button>
                <abbr style="text-decoration: none;" title="unfreind"
                    wire:click='$dispatch("toggle-confirm-modal", {action: "unfriend", data: {{ $friend->id }}})'
                    class="unfreind"><i class="fa-solid fa-user-xmark"></i> <span>unfriend</span> </abbr>
            </button>
        @else
            <button class="user-card-btn">
                <a class="a" wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">
                    <span>Friends</span>
                    <i style="display: none" class="fa-solid fa-user"></i>
                </a>
            </button>
        @endif
    @else
        <button class="user-card-btn">
            <a class="a" wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">
                <span>Show Profile</span>
                <i style="display: none" class="fa-solid fa-user"></i>
            </a>
        </button>
    @endif
@endif
