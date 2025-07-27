<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class FailureResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        logger('Booting FailureResponseProvider');
        Response::macro('failure', function ($message = null, $statusCode = 400) {
            return response()->json([
                'status' => 'failure',
                'message' => $message,
                'code' => $statusCode,
            ], $statusCode);
        });
    }
}
