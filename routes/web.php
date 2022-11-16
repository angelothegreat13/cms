<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Auth::routes();
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () { 

});