<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ExperienceLevel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ExperienceLevelController extends Controller
{
    //

    public function index()
    {
        $experienceLevels = ExperienceLevel::all();
        $parentItemActive = 8;
        $itemActive = 5;
        return view('panel.settings.experience_levels.index', compact('parentItemActive', 'itemActive', 'experienceLevels'));
    }

    public function create()
    {
        return view('panel.settings.experience_levels.create');
    }

    public function store(Request $request)
    {
        $experienceLevel = new ExperienceLevel();
        $experienceLevel->name = $request->name;
        $experienceLevel->description = $request->description;
        $experienceLevel->save();
        return redirect()->route('settings.experience-levels.index');
    }

    public function show($id)
    {
        return view('panel.settings.experience_levels.show');
    }

    public function edit($id)
    {
        return view('panel.settings.experience_levels.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('settings.experience-levels.index');
    }

    public function destroy($id)
    {
        return redirect()->route('settings.experience-levels.index');
    }
}
