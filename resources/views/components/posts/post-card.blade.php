<div class="post_card">
    <div class="post_card_header">
        <a href="./profie.html">
            <img src={{ $post->author->image() }} alt="post_image">
        </a>
        <div>
            <a href="./profie.html">
                <p>{{ $post->author->name }}</p>
            </a>
            <span><i class="fa-solid fa-clock"></i>12 minutes ago</span>
        </div>
        <div class="open_post_options"></div>
    </div>
    <div class="post_card_body">
        <h3>{{ $post->title }}</h3>
        @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="post_img" width="100%">
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
        <div class="comment_section">
            <p class="comment_toggle">Comments<i class="fa-solid fa-chevron-down"></i></p>
            <div class="comment">
                <div class="comment_header">
                    <img src='{{ asset('images/ipsum.jpg') }}' alt="ferind_img">
                    <div class="comment_content">
                        <p>
                            <b>Lorem Ipsum: </b>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ea amet
                            quire, modi voluptatibus veritatis eaque veniam quasi eos deleniti!
                        </p>
                        <span><i class="fa-solid fa-clock"></i>12 Minutes ago</span>
                    </div>
                </div>
            </div>
            <div class="comment">
                <div class="comment_header">
                    <img src='{{ asset('images/lorem.jpg') }}' alt="ferind_img">
                    <div class="comment_content">
                        <p>
                            <b>Lorem Ipsum: </b>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ea amet
                            quire, modi voluptatibus veritatis eaque veniam quasi eos deleniti!
                        </p>
                        <span><i class="fa-solid fa-clock"></i>12 Minutes ago</span>
                    </div>
                </div>
            </div>
            <a href="#" style="color: rgb(74, 74, 219); text-align: center;">View all comments</a>
        </div>
    </div>
</div>
