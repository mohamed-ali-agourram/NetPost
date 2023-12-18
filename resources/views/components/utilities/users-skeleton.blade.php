<div class="skeleton_wrapper users_skeleton">
    <style>
        .users_skeleton {
            gap: 10px;

            & .skeleton {
                width: 65%;
                height: 12.5vh !important;
            }
        }

        .user-card {
            justify-content: space-between;
            flex-direction: row;
            align-items: center;
            padding: 2vh 3vh;

            & img {
                height: 45px;
                width: 45px;
            }

        }

        .skeleton_btn {
            animation: glowAnimation 3s infinite;
            width: 150px;
            height: fit-content;
            height: 5.5vh !important;
        }

        .status {
            font-size: 15.5px !important;
        }

        .post_card_header {
            display: flex
        }

        .skeleton_card_header {
            & span {
                width: 80px !important;
            }

            & p {
                width: 120px !important;
            }
        }
    </style>
    <div class="skeleton user-card">
        <div class="post_card_header">
            <div class="img"></div>
            <div class="skeleton_card_header">
                <span></span>
                <p></p>
            </div>
        </div>
        <button class="skeleton_btn"></button>
    </div>
    <div class="skeleton user-card">
        <div class="post_card_header">
            <div class="img"></div>
            <div class="skeleton_card_header">
                <span></span>
                <p></p>
            </div>
        </div>
        <button class="skeleton_btn"></button>
    </div>
</div>
