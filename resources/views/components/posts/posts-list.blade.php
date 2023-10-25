<div class="posts">
    <div class="open_model" @click="$dispatch('open-form')">
        <div class="open_ps">
            <a href="./profie.html">
                <img src="{{ auth()->user()->image() }}" alt="user">
            </a>
            <input type="text" placeholder="What are you thinking about?" readonly>
        </div>
        <div class="cta_icons">
            <div class="icons">
                <i class='bx bx-camera'></i>
                <i class='bx bx-image-alt'></i>
                <i class='bx bx-happy'></i>
            </div>
            <button id="post">Post</button>
        </div>
    </div>
    @forelse ($this->posts as $post)
        <x-posts.post-card :key="'post-'.$post->id" :$post />
    @empty
        <div>No Post Found...</div>
    @endforelse
    <div>
        {{ $this->posts->links("pagination") }}
    </div>
</div>
