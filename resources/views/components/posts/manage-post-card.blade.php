<div class="manage_post_card">
    @if ($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}">
    @endif
    <div>
        <div class="manage_post_card_body">
            <div class="manage_post_card_controls">
                <button><i class="fa-solid fa-pen-to-square"></i></button>
                <button><i class="fa-solid fa-trash"></i></button>
            </div>
            <h2>{{ $post->title }}</h2>
            <p style="color: grey;">{{ $post->body }}</p>

        </div>
    </div>
</div>
