<?php

use App\Http\Controllers\LEDController;
use App\Http\Controllers\LedControllerDB;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use App\Service\WhatsappNotificationService;
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

// Route::get('/LEDControllers', function () {
//     return view('pages.LEDControl');
// })->middleware(['auth', 'verified']);

Route::get('/sensor', function () {
    $data['title'] = 'Sensor';
    $data['breadcrumbs'][] = [
        'title' => 'Sensor',
        'url' => route('sensor.index')
    ];
    return view('pages.sensor', $data);
})->middleware(['auth', 'verified'])->name('sensor.index');


// Route::get('/sensors', function () {
//     return view('pages.sensor');
// })->middleware(['auth', 'verified']);

// Route::get('/user', function () {
//     return view('pages.user');
// })->middleware(['auth', 'verified']);
Route::controller(LedController::class)->group(function () {
    Route::get('/leds', 'index')->name('led.index');
    Route::post('/leds', 'store')->name('led.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //User
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/whatsapp', function () {
        $target = request('target');
        $message = 'Ada kebocoran gas dirumah anda, segera cek sekarang!';
        $response = WhatsappNotificationService::sendMessage($target, $message);

        echo $response;
    });

    //Sensor
    Route::get('Sensors', [SensorController::class, 'index'])->name('sensors.index');

    //LED Control
    Route::get('LedControllers', [LEDController::class, 'index'])->name('LEDControllers.index');

//     Route::controller(LEDController::class)->group(function() {
//     Route::get('/leds', 'index')->name ('led');
// });
});



require __DIR__ . '/auth.php';
