<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Equipament;
use Illuminate\Http\Request;

class EquipamentController extends Controller
{
    //
    public function index()
    {
        $equipaments = Equipament::all();
        $parentItemActive = 7;
        $itemActive = 2;
        return view('panel.settings.equipaments.index', compact('equipaments', 'itemActive', 'parentItemActive'));
    }

    public function create()
    {
        return view('panel.settings.equipaments.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipament = new Equipament();
        $equipament->name = $request->name;
        $equipament->description = $request->description;
        $equipament->unit = 'pz';
        $equipament->save();

        return redirect()->route('settings.equipaments.index');

    }

    public function show($id)
    {
        //
        $equipament = Equipament::find($id);
        return view('panel.settings.equipaments.show', compact('equipament'));
    }

    public function edit($id)
    {
        //
        $equipament = Equipament::find($id);
        return view('panel.settings.equipaments.edit', compact('equipament'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipament = Equipament::find($id);
        $equipament->name = $request->name;
        $equipament->description = $request->description;
        $equipament->unit = 'pz';
        $equipament->save();

        return redirect()->route('settings.equipaments.index');
    }

    public function destroy($id)
    {
        //
        $equipament = Equipament::find($id);
        $equipament->delete();

        return redirect()->route('settings.equipaments.index');
    }


}
