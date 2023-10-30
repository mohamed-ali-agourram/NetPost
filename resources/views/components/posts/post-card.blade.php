<div class="post_card">
    <div class="post_card_header">
        <a href="./profie.html">
            <img src={{ $post->author->image() }} alt="post_image">
        </a>
        <div>
            <a href="./profie.html">
                <b>{{ $post->author->name }}</b>
            </a>
            <p class="date_span">
                <span>{{ $post->date() }}</span>
                @if ($post->is_published === '1')
                    <i title="public" class="fa-solid fa-earth-africa"></i>
                @else
                    <i title="private" class="fa-solid fa-lock"></i>
                @endif
            </p>
        </div>
        <div class="open_post_options"></div>
    </div>
    <div class="post_card_body">
        <h3>{{ $post->body }}</h3>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="post_img" width="100%">
        @endif
    </div>
    <div class="post_card_footer">
        <div class="pcf_icons">
            <p>
                <i class="fa-solid fa-thumbs-up"></i>
                <span class="pcf_action">Likes</span>
                <span class="n_activity">11</span>
            </p>
            <p>
                <i class="fa-solid fa-message"></i>
                <span class="pcf_action">Comments</span>
                <span class="n_activity">11</span>
            </p>
            <p>
                <i class="fa-solid fa-share"></i>
                <span class="pcf_action">Shares</span>
                <span class="n_activity">11</span>
            </p>
        </div>
        <form action="/" class="comment">
            <img src={{ auth()->user()->image() }} alt="{{ auth()->user()->name }}">
            <input type="text" placeholder="Comment what you think">
            <button>
                <i class='bx bxs-send'></i>
            </button>
        </form>
    </div>
</div>
