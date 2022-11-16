<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\PageController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\HomePageController;

Route::prefix('v1')->name('api.v1.')->group(function() {
    Route::post('/login',[AuthController::class, 'login'])->name('auth.login');
    Route::post('/register',[AuthController::class, 'register'])->name('auth.register');
});

Route::prefix('v1')->name('api.v1.')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/home-page/{id}', [HomePageController::class, 'show'])->name('homePage.show');
    Route::post('/home-page/store', [HomePageController::class, 'store'])->name('homePage.store');
});
