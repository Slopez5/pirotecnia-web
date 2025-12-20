<?php

use App\Presentation\Http\Controllers\API\DashboardController;
use App\Presentation\Http\Controllers\API\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('v2')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    Route::get('event/{id}', [EventController::class, 'eventDetails']);
    Route::post('event', [EventController::class, 'createEvent']);
});
