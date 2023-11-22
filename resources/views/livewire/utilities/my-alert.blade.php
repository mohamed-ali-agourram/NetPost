<div class="alert">
    <div class="alert-header">
        <span>New Notification</span>
        <button><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="alert-infos">
        <div class="alert-author">
            <img src="{{ auth()->user()->profile_image() }}" alt="{{ auth()->user()->name }}'s img">
            <i class="fa-regular fa-user"></i>
        </div>
        <div class="alert-body">
            <div>
                <p> <b>{{ auth()->user()->name }}</b> your profile has been updated</p>
                <div></div>
            </div>
            <span>1 second ago</span>
        </div>
    </div>
</div>
