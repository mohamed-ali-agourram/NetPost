@props(['user', 'is_friendpage' => false, 'friend' => null])
@php
    $auth = auth()->user();
@endphp
@if ($user->id === $auth->id)
    <button> <a wire:navigate href="{{ route('profile', ['slug' => $auth->slug]) }}">Show
            Profile</a></button>
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
            <button> <a wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">Friends</a></button>
        @endif
    @else
        <button> <a wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">Show
                Profile</a></button>
    @endif
@endif
