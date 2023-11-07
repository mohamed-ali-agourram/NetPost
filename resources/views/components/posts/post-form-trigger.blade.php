<div class="open_model" @click="$dispatch('open-form')">
    <div class="open_ps">
        <img src="{{ auth()->user()->profile_image() }}" alt="user">
        <input type="text" placeholder="What are you thinking about?" readonly>
    </div>
    <div class="cta_icons">
        <div class="icons">
            <i class='bx bx-camera'></i>
            <i class='bx bx-image-alt'></i>
            <i class='bx bx-happy'></i>
        </div>
        <button>Post</button>
    </div>
</div>
