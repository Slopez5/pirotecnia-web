<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class SuccessResponseProvider extends ServiceProvider
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
        Response::macro('success', function ($data = null, $statusCode = 200) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'code' => $statusCode,
            ], $statusCode);
        });
    }
}
