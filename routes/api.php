<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/services', [ServiceController::class, 'index']);

    Route::get('/availability', [AppointmentController::class, 'availability']);

    Route::get('/appointments/my', [AppointmentController::class, 'myAppointments']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'cancel']);

    Route::middleware('admin')->group(function () {
        Route::post('/admin/services', [AdminServiceController::class, 'store']);
        Route::put('/admin/services/{service}', [AdminServiceController::class, 'update']);
        Route::patch('/admin/services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus']);

        Route::get('/admin/appointments', [AdminAppointmentController::class, 'index']);
        Route::patch('/admin/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus']);
    });
});

