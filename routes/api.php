<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Public services (customers can browse them).
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/availability', [AppointmentController::class, 'availability']);

    Route::middleware('auth:sanctum')->get('/appointments/my', [AppointmentController::class, 'myAppointments']);
    Route::middleware('auth:sanctum')->post('/appointments', [AppointmentController::class, 'store']);
    Route::middleware('auth:sanctum')->delete('/appointments/{id}', [AppointmentController::class, 'cancel']);
    
    Route::middleware('admin')->group(function () {
        Route::post('/services', [ServiceController::class, 'store']);
        Route::put('/services/{service}', [ServiceController::class, 'update']);
        Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

        Route::middleware(['auth:sanctum', 'admin'])->group(function () {
            Route::get('/admin/appointments', [AdminAppointmentController::class, 'index']);
            Route::patch('/admin/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus']);
        });
     });
});

