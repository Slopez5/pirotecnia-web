<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FailureResponseProvider::class,
    App\Providers\SuccessResponseProvider::class,
    Barryvdh\DomPDF\ServiceProvider::class,
    Laravel\Passport\PassportServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
];
