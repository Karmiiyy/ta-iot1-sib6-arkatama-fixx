<?php

use App\Http\Controllers\LEDController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data['title'] = 'Dashboard';
    $data['breadcrumbs'][] = [
        'title' => 'Dashboard',
        'url' => route('dashboard')
    ];

    return view('pages.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('pages_LEDControl');
})->middleware(['auth', 'verified']);

Route::get('/sensors', function () {
    return view('pages.sensor');
})->middleware(['auth', 'verified']);

Route::get('/user', function () {
    return view('pages.user');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //User
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    //Sensor
    Route::get('Sensors', [SensorController::class, 'index'])->name('sensors.index');

    //LED Control
    Route::get('LEDControllers', [LEDController::class, 'index'])->name('LEDControllers.index');
});



require __DIR__ . '/auth.php';
