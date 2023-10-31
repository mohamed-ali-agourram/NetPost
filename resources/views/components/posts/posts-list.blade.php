<div class="posts">
    <x-posts.post-form-trigger />
    @forelse ($this->posts as $post)
        <x-posts.post-card :key="'post-'.$post->id" :$post />
    @empty
        <div>No Post Found...</div>
    @endforelse
    {{-- <div>
        {{ $this->posts->links("pagination") }}
    </div> --}}
</div>
