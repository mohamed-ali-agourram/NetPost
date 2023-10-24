<div class="manage_post_card">
    <img src="{{ $post->image() }}" alt="{{ $post->title }}">
    <div class="manage_post_card_body">
        <div class="manage_post_card_controls">
            <button><i class="fa-solid fa-pen-to-square"></i></button>
            <button wire:click='$dispatch("toggle-confirm-modal", {action: "delete-post", data: "{{ $post->id }}"})' ><i class="fa-solid fa-trash"></i></button>
        </div>
        <h2>{{ $post->title }}</h2>
        <p style="color: grey;">{{ $post->body }}</p>
    </div>
</div>
