<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $auth = auth()->user();
        dd($auth->pendingFriendsTo->contains("id", 5));
        return view("test", []);
    }
}
