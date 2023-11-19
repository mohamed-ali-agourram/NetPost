<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $auth = auth()->user();
        dd($auth->pendingRequestsRelation);
        dd($auth->friends);
        return view("test", ["data" => []]);
    }
}
