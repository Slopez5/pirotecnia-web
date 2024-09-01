<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
{
    //

    public function index()
    {
        $parentItemActive = 7;
        $itemActive = 3;
        return view('panel.settings.client_types.index', compact('itemActive', 'parentItemActive'));
    }

    public function create()
    {
        return view('panel.settings.client_types.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('settings.client-types.index');
    }

    public function show($id)
    {
        return view('panel.settings.client_types.show');
    }

    public function edit($id)
    {
        return view('panel.settings.client_types.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('settings.client-types.index');
    }

    public function destroy($id)
    {
        return redirect()->route('settings.client-types.index');
    }
}
