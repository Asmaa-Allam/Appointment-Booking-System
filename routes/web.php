<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Models\Service;


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home', [
        'appointmentsCount' => auth()->user()->appointments()->count() ?? 0
    ]);
})->name('home')->middleware('auth');

    // عرض صفحة حجز الموعد
Route::get('/appointments/create/{service}', [AppointmentController::class, 'create'])
    ->name('appointments.create')
    ->middleware('auth');

    // حفظ الحجز
Route::post('/appointments/store', [AppointmentController::class, 'store'])
->name('appointments.store')
->middleware('auth');


Route::get('/services', function () {
    $services = Service::all();
    return view('services.index', compact('services'));
})->name('services.index');

Route::get('/my', function () {
    return view('appointments.my');
})->name('appointments.my');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/', function () {
    return view('welcome');
});
