@props(['user'])
<abbr title="unfreind">
    <button wire:click='$dispatch("toggle-confirm-modal", {action: "unfriend", data: {{ $user->id }}})' class="unfriend-modal">
        <i class="fa-solid fa-user-xmark"></i>
        Unfreind {{ $user->name }}
    </button>
</abbr>
