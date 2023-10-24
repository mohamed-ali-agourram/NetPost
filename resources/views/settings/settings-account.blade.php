<x-layouts.settings-app-layout>
    <div class="settings_content">
        <div class="acount_settings_header">
            <div class="profile_img">
                <img src="../assets/images/profile_img.jpg" alt="">
                <button class="pp_btn"><i class='bx bx-camera'></i></button>
            </div>
            <div class="profile_info">
                <h1>Lorem Ipsum User</h1>
                <p class="status"><span style="color: grey; font-size: 15px;">status:</span> Availabale</p>
                <div class="user_activity">
                    <p>
                        <span>120 freinds</span>
                        <i class="fa-regular fa-user"></i>
                    </p>
                    <p>
                        <span>2 posts</span>
                        <i class="fa-regular fa-images"></i>
                    </p>
                    <p>
                        <span>25 likes</span>
                        <i class="fa-regular fa-thumbs-up"></i>
                    </p>
                </div>
            </div>
        </div>
        <ul>
            <h2>Personal Informations</h2>
            <li>
                <div>
                    <label for="user_name">User Name</label>
                    <input type="text" id="user_name" name="user_name" value="Lorem Ipsum User">
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
            <li>
                <div>
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status" value="Availabale">
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
            <li>
                <div>
                    <label for="email">Email</label>
                    <input type="text" value="loremipsum@gmail.com">
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
            <li>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="randompass">
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
        </ul>
        <div class="action_div">
            <p>
                <i style="color: yellow;" class="fa-solid fa-triangle-exclamation"></i>
                <span>This Acion is Permanent</span>
            </p>
            <button>
                <i class="fa-solid fa-trash"></i>
                <span>Delete Account</span>
            </button>
        </div>
    </div>
</x-layouts.settings-app-layout>