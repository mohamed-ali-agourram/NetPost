<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $auth = auth()->user();
        dd($auth->pendingRequests);
        // auth()->user()->friends()->paginate(10);
        return view("test", []);
    }
}
