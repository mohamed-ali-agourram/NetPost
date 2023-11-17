<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(string $slug){
        $user = User::where("slug", $slug)->first();
        return view("profile", ["user" => $user]);
    }
}
