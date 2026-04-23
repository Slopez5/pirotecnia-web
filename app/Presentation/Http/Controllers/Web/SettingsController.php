<?php

namespace App\Presentation\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function indexSettings()
    {
        return view('panel.settings.settings');
    }
}
