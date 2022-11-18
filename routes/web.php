<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () { 
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Home Page
    Route::prefix('home-pages')->name('home-pages.')->group(function () {
        Route::get('/',[HomePageController::class, 'index'])->name('index');
        Route::get('/create',[HomePageController::class, 'create'])->name('create');
        Route::post('/store',[HomePageController::class, 'store'])->name('store');
        Route::get('/{homePage}/edit',[HomePageController::class, 'create'])->name('edit');
        Route::patch('/{homePage}',[HomePageController::class, 'update'])->name('update');
        Route::delete('/{homePage}',[HomePageController::class, 'destroy'])->name('delete');
    });

    // User

});