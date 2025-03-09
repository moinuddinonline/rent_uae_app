<?php

use App\Http\Controllers\Admin\RentTypeController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\RentVendorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['permission:rent_module'])->group(function () {
    Route::prefix('rent-types')
        ->controller(RentTypeController::class)
        ->middleware(['permission:rent_type_*'])
        ->name('rent_types.')
        ->group(function () {
            Route::get('/list/{type?}', 'index')
                ->middleware(['permission:rent_type_read'])
                ->name('list');
            Route::get('/create', 'create')
                ->middleware(['permission:rent_type_create'])
                ->name('create');
            Route::post('/store', 'store')
                ->middleware(['permission:rent_type_create'])
                ->name('store');
            Route::get('/{id}/edit', 'edit')
                ->middleware(['permission:rent_type_update'])
                ->name('edit');
            Route::patch('/{id}/update', 'update')
                ->middleware(['permission:rent_type_update'])
                ->name('update');
            Route::delete('/destroy/{id}', 'destroy')
                ->middleware(['permission:rent_type_delete'])
                ->name('destroy');
            Route::put('/archive/{id}', 'archive')
                ->middleware(['permission:rent_type_update'])
                ->name('archive');
            Route::put('/restore/{id}', 'restore')
                ->middleware(['permission:rent_type_update'])
                ->name('restore');
        });


    Route::prefix('rents')
        ->controller(RentController::class)
        ->middleware(['permission:rent_*'])
        ->name('rents.')
        ->group(function () {
            Route::get('/list', 'index')
                ->middleware(['permission:rent_read'])
                ->name('list');
            Route::get('/rent-view/{rent_id}', 'rentView')
                ->middleware(['permission:rent_update'])
                ->name('rent-view');
            Route::patch('/{rent_id}/update', 'updateRent')
                ->middleware(['permission:rent_update'])
                ->name('rent-update');
            Route::post('/export', 'exportRent')
                ->middleware(['permission:export_rent'])
                ->name('export');

        });


    Route::prefix('rent-vendors')
        ->controller(RentVendorController::class)
        ->middleware(['permission:rent_vendor_*'])
        ->name('rent_vendors.')
        ->group(function () {
            Route::get('/list', 'index')
                ->middleware(['permission:rent_vendor_read'])
                ->name('list');

        });

});