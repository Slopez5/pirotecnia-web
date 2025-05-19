<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $data = [];

        return response()->success($data);
    }
}
