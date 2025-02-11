<?php

return [
    App\Providers\AppServiceProvider::class,
    'PDF' => Barryvdh\DomPDF\ServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
    Laravel\Passport\PassportServiceProvider::class,
];
