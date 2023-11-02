<div class="post_from_model" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="post_from_model_backdrop" @click="$dispatch('close-modal')"></div>
    <div class="post-card-model">
        <div class="header">
            <h2>{{ $post?->author->name }}'s Post</h2>
            <button type="button" class="cancel" @click="$dispatch('close-modal')">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>
        <div class="body">
            <div class="author">
                <img src="{{ $post?->author->image() }}" alt="author">
                <div>
                    <b>{{ $post?->author->name }}</b>
                    <p>
                        <span>{{ $post?->date() }}</span>
                        @if ($post?->is_published === '1')
                            <i title="public" class="fa-solid fa-earth-africa"></i>
                        @else
                            <i title="private" class="fa-solid fa-lock"></i>
                        @endif
                    </p>
                </div>
            </div>
            <div class="description">
                <p>{{ $post?->body }}</p>
                <img src="{{ $post?->image() }}" alt="post-img">
            </div>
            <div class="pcf_icons">
                @php
                    $is_liked = auth()->user()->has_liked($post);
                @endphp
                <button  wire:loading.attr="disabled" style="background: {{ $is_liked ? 'rgba(46, 46, 46, 0.548)' : 'transparent' }}" wire:click="toggleLike">
                    <i style="color: {{ $is_liked ? 'red' : 'gray' }}" class="fa-solid fa-thumbs-up"></i>
                    <span class="pcf_action">Likes</span>
                    @if ($post?->likes()->count() > 0)
                        <span class="n_activity">{{ $post?->likes()->count() }}</span>
                    @endif
                </button>
                <button>
                    <i class="fa-solid fa-message"></i>
                    <span class="pcf_action">Comments</span>
                    <span class="n_activity">11</span>
                </button>
                <button>
                    <i class="fa-solid fa-share"></i>
                    <span class="pcf_action">Shares</span>
                    <span class="n_activity">11</span>
                </button>
            </div>
        </div>
        <div class="comments">
            <div class="filter">
                <p>Newest First</p>
                <i class="fas fa-angle-down"></i>
            </div>
            <div class="comment">
                <img src={{ asset('images/user4.jpg') }} alt="">
                <div class="content">
                    <div class="bubble">
                        <b>Lorem Ipsum<span>&nbsp;&nbsp;4h</span></b>
                        <p>Lorem ipsum do Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti minima dicta
                            placeat. Impedit odio eligendi quos quae quod, nesciunt beatae. Vitae facilis odit possimus
                            cupiditate ut. Ipsam soluta exercitationem et? lo</p>
                    </div>
                </div>
            </div>
            <div class="comment">
                <img src={{ asset("images/profile_img.jpg") }} alt="">
                <div class="content">
                    <div class="bubble">
                        <b>Lorem Ipsum<span>&nbsp;&nbsp;4h</span></b>
                        <p>Lorem ipsu nisi voluptate! Asperiores quidem voluptatum veniam
                            quibusdam</p>
                    </div>
                </div>
            </div>
            <div class="comment">
                <img src={{ asset('images/user3.jpg') }} alt="">
                <div class="content">
                    <div class="bubble">
                        <b>Lorem Ipsum<span>&nbsp;&nbsp;4h</span></b>
                        <p>Lorem ipsum dolor</p>
                    </div>
                </div>
            </div>
            <div class="comment">
                <img src={{ asset('images/user2.jpg') }} alt="">
                <div class="content">
                    <div class="bubble">
                        <b>Lorem Ipsum<span>&nbsp;&nbsp;4h</span></b>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing em</p>
                    </div>
                </div>
            </div>
            <div class="comment">
                <img src={{ asset('images/default_user.png') }} alt="">
                <div class="content">
                    <div class="bubble">
                        <b>Lorem Ipsum<span>&nbsp;&nbsp;4h</span></b>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus
                            tempore veniam nisi voluptate! Asperiores quidem voluptatum veniam
                            quibusdam</p>
                    </div>
                </div>
            </div>
        </div>
        <form class="form" action="#">
            <img src="{{ $post?->author->image() }}" alt="author">
            <div>
                <textarea name="" id="" cols="30" rows="10" placeholder="What you think about it?"></textarea>
                <button type="submit" title="send" class="send">
                    <i class='bx bxs-send'></i>
                </button>
            </div>
        </form>
    </div>
</div>
