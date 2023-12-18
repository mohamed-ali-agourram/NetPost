<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function home($is_friend_page = null)
    {
        return view("home", ["is_friend_page" => $is_friend_page]);
    }

    public function friends_page()
    {
        return view("home", ["is_friend_page" => true]);
    }
}
