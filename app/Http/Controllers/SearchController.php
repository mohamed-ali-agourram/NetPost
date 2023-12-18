<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query("search");
        $filter = $request->query("filter");
        return view("search", ["search" => $search, "filter" => $filter]);
    }
}
