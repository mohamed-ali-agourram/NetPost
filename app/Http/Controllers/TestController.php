<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $data = auth()->user()->acceptedFriendsTo;
        return view("test", ["data" => $data]);
    }
}
