<x-layouts.app-layout>
    <div class="main_content">
        @php
            $is_friend_page = isset($is_friend_page);
        @endphp
        <livewire:post.posts-list :$is_friend_page />
        <livewire:user.freinds-list />
    </div>
</x-layouts.app-layout>
