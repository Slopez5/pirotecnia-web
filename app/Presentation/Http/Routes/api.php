<?php

use App\Presentation\Http\Controllers\API\AuthController;
use App\Presentation\Http\Controllers\API\DashboardController;
use App\Presentation\Http\Controllers\API\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('v2')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/recovery', [AuthController::class, 'recovery']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/fcm-token', [AuthController::class, 'saveFCMToken']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('dashboard', [DashboardController::class, 'dashboard']);
        Route::get('event/{id}', [EventController::class, 'eventDetails']);
        Route::post('event', [EventController::class, 'createEvent']);
    });

});
