<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\equipment;
use Illuminate\Http\Request;

class equipmentController extends Controller
{
    //
    public function index()
    {
        $equipments = equipment::all();
        $parentItemActive = 7;
        $itemActive = 2;
        return view('panel.settings.equipments.index', compact('equipments', 'itemActive', 'parentItemActive'));
    }

    public function create()
    {
        return view('panel.settings.equipments.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipment = new equipment();
        $equipment->name = $request->name;
        $equipment->description = $request->description;
        $equipment->unit = 'pz';
        $equipment->save();

        return redirect()->route('settings.equipments.index');

    }

    public function show($id)
    {
        //
        $equipment = equipment::find($id);
        return view('panel.settings.equipments.show', compact('equipment'));
    }

    public function edit($id)
    {
        //
        $equipment = equipment::find($id);
        return view('panel.settings.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipment = equipment::find($id);
        $equipment->name = $request->name;
        $equipment->description = $request->description;
        $equipment->unit = 'pz';
        $equipment->save();

        return redirect()->route('settings.equipments.index');
    }

    public function destroy($id)
    {
        //
        $equipment = equipment::find($id);
        $equipment->delete();

        return redirect()->route('settings.equipments.index');
    }


}
