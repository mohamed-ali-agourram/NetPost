@props(['user'])
<style>
    .unfriend-modal {
        position: absolute;
        right: 0;
        background: #0000009c;
        border-radius: 4px;
        color: white;
        padding: 2vh 1.5vh;
        margin-top: 2px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        gap: 6px;
        align-items: center;
        width: 130%;
        border: none
    }

    [x-cloak] {
        display: none;
    }
</style>
<abbr title="unfreind">
    <button wire:click='$dispatch("toggle-confirm-modal", {action: "unfriend", data: {{ $user->id }}})' class="unfriend-modal">
        <i class="fa-solid fa-user-xmark"></i>
        Unfreind {{ $user->name }}
    </button>
</abbr>
