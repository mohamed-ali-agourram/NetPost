@props(['is_freindship', 'user'])
@php
    $auth = auth()->user();
@endphp
<div class="profile_cta">
    @if (!$is_freindship)
        <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-user-plus"></i> Add
            friend</button>
    @else
        @if ($auth->pendingFriendsFrom->contains('id', $user->id))
            <div class="accept-reject-btns" style="display: {{ !$is_freindship ? 'none' : 'flex' }}">
                <button wire:click='handle_request(true)' class="p_cta_btn add-freind"><i
                        class="fa-solid fa-user-check"></i>
                    Accept Request</button>
                <button wire:click='handle_request(false)' class="p_cta_btn add-freind reject"><i
                        class="fa-solid fa-xmark"></i>
                    Reject Request</button>
            </div>
        @elseif ($auth->pendingFriendsTo->contains('id', $user->id))
            <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-xmark"></i>
                Cancel Request</button>
        @else
            <div style="position: relative; width: 100%" x-data="{ isOpen: false }" @click.away="isOpen = false">
                <button @click="isOpen = !isOpen" class="p_cta_btn add-freind"><i class="fa-solid fa-user-group"></i>
                    Friends <i class="fa-solid fa-chevron-down"></i></button>
                <div x-show="isOpen" @click="isOpen = false" x-cloak>
                    <x-unfriend-modal :$user />
                </div>
            </div>
        @endif
    @endif
</div>
