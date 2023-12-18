<div class="posts">
    <x-posts.post-form-trigger />
    @forelse ($this->posts as $post)
        <x-posts.post-card :key="'post-' . $post->id" :$post />
    @empty
        <h2 style="color: white; text-align: center; padding: 2vh;">No Post Found...</h2>
    @endforelse
    <div style="margin-bottom: -15px" x-intersect="$wire.load_more()"></div>
    @unless ($is_bottom && !$loadingMore)
        <x-utilities.skeleton />
    @endunless
    @if ($is_bottom)
        <div class="bottom">
            <h2>You reached the bottom</h2>
            <i class="fa-solid fa-anchor"></i>
        </div>
    @endif
</div>
