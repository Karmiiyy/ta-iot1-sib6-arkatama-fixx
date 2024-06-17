<?php

use App\Http\Controllers\Api\Dht11Controller;
use App\Http\Controllers\Api\MqSensorController;
use App\Http\Controllers\Api\RainSensorController;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\LEDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route group api
Route::group(['as' => 'api.'], function () {
    // resource route
    Route::resource('users', UserController::class)
        ->except(['create', 'edit']);

    Route::resource('sensors/mq', MqSensorController::class)
        ->names('sensors.mq');

        Route::resource('sensors/dht11', Dht11Controller::class)
        ->names('sensors.dht11')
        ->only(['index', 'store']);

    Route::resource('sensors/rain', RainSensorController::class) // Sesuaikan nama controller
        ->names('sensors.rain');

    Route::prefix('v1/leds')->name('leds.')->group(function () {
        Route::get('/', [LedController::class, 'index'])
            ->name('index');
        Route::get('/{id}', [LedController::class, 'show'])
            ->name('show');
        Route::post('/', [LedController::class, 'store'])
            ->name('store');
        Route::put('/{id}', [LedController::class, 'update'])
            ->name('update');
        Route::delete('/{id}', [LedController::class, 'destroy'])
            ->name('destroy');
    });
});
