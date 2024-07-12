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
        return view('panel.settings.equipaments.index', compact('equipaments'));
    }

    public function create()
    {
        return view('panel.settings.equipaments.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
