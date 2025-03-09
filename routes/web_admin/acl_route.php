<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;


Route::middleware(['permission:access'])->group(function () {
    Route::prefix('user')
        ->controller(UserController::class)
        ->middleware(['permission:user_*'])
        ->name('user.')
        ->group(function () {
            Route::get('/list/{type?}', 'index')
                ->middleware(['permission:user_read'])
                ->name('list');
            Route::get('/create', 'create')
                ->middleware(['permission:user_create'])
                ->name('create');
            Route::post('/store', 'store')
                ->middleware(['permission:user_create'])
                ->name('store');
            Route::get('/show/{id}', 'show')
                ->middleware(['permission:user_read'])
                ->name('show');
            Route::get('/{id}/edit', 'edit')
                ->middleware(['permission:user_update'])
                ->name('edit');
            Route::patch('/{id}/update', 'update')
                ->middleware(['permission:user_update'])
                ->name('update');
            Route::put('/archive/{id}', 'archive')
                ->middleware(['permission:user_delete'])
                ->name('archive');
            Route::put('/restore/{id}', 'restore')
                ->middleware(['permission:user_delete'])
                ->name('restore');
        });

    Route::prefix('role')
        ->controller(RoleController::class)
        ->middleware(['permission:role_*'])
        ->name('role.')
        ->group(function () {
            Route::get('/list', 'index')
                ->middleware(['permission:role_read'])
                ->name('list');
            Route::get('/create', 'create')
                ->middleware(['permission:role_create'])
                ->name('create');
            Route::post('/store', 'store')
                ->middleware(['permission:role_create'])
                ->name('store');
            Route::get('/{id}/edit', 'edit')
                ->middleware(['permission:role_update'])
                ->name('edit');
            Route::patch('/{id}/update', 'update')
                ->middleware(['permission:role_update'])
                ->name('update');
            Route::delete('/destroy/{id}', 'destroy')
                ->middleware(['permission:role_delete'])
                ->name('destroy');
        });

    Route::prefix('permission')
        ->controller(PermissionController::class)
        ->middleware(['permission:permission_*'])
        ->name('permission.')
        ->group(function () {
            Route::get('/list', 'index')
                ->middleware(['permission:permission_read'])
                ->name('list');
            Route::get('/create', 'create')
                ->middleware(['permission:permission_create'])
                ->name('create');
            Route::post('/store', 'store')
                ->middleware(['permission:permission_create'])
                ->name('store');
            Route::get('/{id}/edit', 'edit')
                ->middleware(['permission:permission_update'])
                ->name('edit');
            Route::patch('/{id}/update', 'update')
                ->middleware(['permission:permission_update'])
                ->name('update');
            Route::delete('/destroy/{id}', 'destroy')
                ->middleware(['permission:permission_delete'])
                ->name('destroy');
        });

});

