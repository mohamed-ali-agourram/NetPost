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
            @dump($users)
        @endif
        @if ($posts->isNotEmpty())
            @dump($posts)
        @endif
    @else
        <h1>Nothing Found....</h1>
    @endif
    <div class="posts skeleton_wrapper">
        <div class="skeleton post_card">
            <div class="post_card_header">
                <div class="img"></div>
                <div class="skeleton_card_header">
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="post_card_body">

            </div>
            <div class="post_card_footer">
                <div class="pcf_icons">
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="skeleton post_card">
            <div class="post_card_header">
                <div class="img"></div>
                <div class="skeleton_card_header">
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="post_card_body">

            </div>
            <div class="post_card_footer">
                <div class="pcf_icons">
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

</div>
