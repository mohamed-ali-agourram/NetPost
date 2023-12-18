@props(['user'])
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
        <button> <a wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">Friends</a></button>
    @else
        <button> <a wire:navigate href="{{ route('profile', ['slug' => $user->slug]) }}">Show
                Profile</a></button>
    @endif
@endif
