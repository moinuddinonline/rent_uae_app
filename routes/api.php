<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RentController;
use App\Http\Controllers\Api\ProfileController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/get-otp', [AuthController::class, 'getOtp']);
Route::post('/validate-otp', [AuthController::class, 'validateOtp']);

//Guarded Routes
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/complete-profile', [ProfileController::class, 'completeProfile']);
    Route::post('/get-email-otp', [ProfileController::class, 'getEmailOtp']);
    Route::post('/verify-email-otp', [ProfileController::class, 'verifyEmailOtp']);

    // Rent Module Routes
    Route::get('/get-rent-types', [RentController::class, 'getRentTypes']);
    Route::post('/create-rent', [RentController::class, 'createRent']);
    Route::post('/pay-rent-by-vendor/{vendor_id}', [RentController::class, 'payRentByVendor']);

    Route::get('/rent-payments', [RentController::class, 'rentPayments']);
    Route::get('/rent-payments/detail/{rent_id}', [RentController::class, 'rentPaymentDetail']);
    Route::get('/rent-payments/receipt/{rent_id}', [RentController::class, 'rentPaymentReceipt']);
});