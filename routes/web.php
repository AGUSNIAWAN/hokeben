<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ActivityController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::view('/monitoring', 'monitoring')->name('monitoring');

// Tracking Sheet Routes
use App\Http\Controllers\TrackingController;
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/tracking/sheet', [TrackingController::class, 'storeSheet'])->name('tracking.sheet.store');
Route::put('/tracking/sheet/{id}', [TrackingController::class, 'updateSheet'])->name('tracking.sheet.update');
Route::delete('/tracking/sheet/{id}', [TrackingController::class, 'destroySheet'])->name('tracking.sheet.destroy');

Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');
Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
Route::delete('/vouchers/{voucher}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
