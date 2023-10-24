<x-layouts.settings-app-layout>
    <div class="settings_content posts_settings">
        <div class="settings_content_header">
            <h1 style="color: white;">Manage Your Posts</h1>
            <button><i class="fa-solid fa-trash"></i> Remove All Posts</button>
        </div>
        @forelse (auth()->user()->posts as $post)
            <livewire:manage-post-card :$post />
        @empty
            <h1>Add a new post...</h1>
        @endforelse

    </div>
</x-layouts.settings-app-layout>
