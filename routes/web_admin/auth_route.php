<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('welcome');
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'doLogin')->name('dologin');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});