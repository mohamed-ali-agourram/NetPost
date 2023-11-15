<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name("home")->middleware("auth");

Route::prefix("/auth")->name("auth.")->middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, 'login'])->name("login");
    Route::get("/register", [AuthController::class, 'register'])->name("register");
});

Route::get("/profile/{slug}", [ProfileController::class, "index"])->name("profile")->middleware("auth");

Route::get("/freinds", function () {
    return view("freinds");
})->name("freinds")->middleware("auth");

Route::prefix("settings")->name("settings.")->group(function () {
    Route::get('/account', function () {
        return view("settings.settings-account");
    })->name("account");

    Route::get('/posts', function () {
        return view("settings.settings-posts");
    })->name("posts");

    Route::get('/application', function () {
        return view("settings.settings-application");
    })->name("application");
})->middleware("auth");
