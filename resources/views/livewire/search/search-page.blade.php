<div class="search_content">
    <div class="search_navbar">
        <div class="search_input">
            <i class="fa-solid fa-arrow-left"></i>
            <input type="search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="search_filters">
            <div style="background: rgba(0, 0, 0, 0.644);">
                <i class="fa-solid fa-list"></i>
                <span>All</span>
            </div>
            <div>
                <i class="fa-solid fa-layer-group"></i>
                <span>Post</span>
            </div>
            <div>
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </div>
        </div>
    </div>
    <h2 class="h2" style="margin-top: 10px">Results for "{{ $search }}"</h2>
    @if ($users->isNotEmpty() || $posts->isNotEmpty())
        @if ($users->isNotEmpty())
            <div class="user-card">
                <div class="user-card_header">
                    <img src="{{ $users[0]->profile_image() }}" alt="profile">
                    <div>
                        <h3>{{ $users[0]->name }}</h3>
                        <p class="status"><span>status: </span>{{ $users[0]->status }}</p>
                    </div>
                </div>
                <div>
                    <h4 style="text-decoration: underline">activities</h4>
                    <div class="user_activity">
                        @php
                            $friends_count = $users[0]->friendsRelation()->count();
                            $posts_count = $users[0]->posts->count();
                        @endphp
                        <p>
                            <span>{{ $friends_count }} freind{{ $friends_count > 1 ? 's' : '' }}</span>
                            <i class="fa-regular fa-user"></i>
                        </p>
                        <p>
                            <span>{{ $posts_count }} post{{ $posts_count > 1 ? 's' : '' }}</span>
                            <i class="fa-regular fa-images"></i>
                        </p>
                        <p>
                            <span>{{ $this->likes_count($users[0]) }}</span>
                            <i class="fa-regular fa-thumbs-up"></i>
                        </p>
                    </div>
                </div>
                <button>Add Friend</button>
            </div>
            @if ($users->count() > 1)
                <div class="users-list">
                    <h2 style="text-decoration: underline;">Other users</h2>
                    @foreach ($users as $user)
                        @if ($loop->index != 0 && $loop->index < 5)
                            <div class="user-card">
                                <div class="user-card_header">
                                    <img src="{{ $user->profile_image() }}" alt="profile">
                                    <div>
                                        <h4>{{ $user->name }}</h4>
                                        <p class="status"><span>status: </span>{{ $user->status }}</p>
                                    </div>
                                </div>
                                <button>Add Friend</button>
                            </div>
                        @endif
                    @endforeach
                    <button class="link"><a href="#">See all</a></button>
                </div>
            @endif
        @endif
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <style>
                    .post_card {
                        width: 65% !important;
                    }
                </style>
                @if ($post->is_published)
                    <x-posts.post-card :key="$post?->pluck('id')->join(uniqid())" :$post />
                @endif
            @endforeach
        @endif
    @else
        <h1 style="color: white">Nothing Found....</h1>
    @endif

</div>
