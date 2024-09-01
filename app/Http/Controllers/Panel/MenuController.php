<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //

    public function index()
    {
        $menu = Menu::find(1)->menuItems->where('url', '!=', '');
        return view('panel.settings.menu.index', compact('menu'));
    }

    public function create()
    {

        $menus = Menu::find(1)->menuItems->where('parent_id', null);
        return view('panel.settings.menu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $menu = Menu::find(1);
        $order = 0;
        if ($request->parent_id) {
            $order = MenuItem::where('parent_id', $request->parent_id)->max('order') + 1;
        } else {
            $order = MenuItem::where('parent_id', null)->max('order') + 1;
        }
        $menu->menuItems()->create([
            'title' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'order' => $order,
            'active' => 1,
        ]);
        $menu->save();

        return redirect()->route('settings.menu.index');
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('panel.settings.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->url = $request->url;
        $menu->save();

        return redirect()->route('settings.menu.index');
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return redirect()->route('settings.menu.index');
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('panel.settings.menu.show', compact('menu'));
    }

    public function active($id)
    {
        $menu = MenuItem::find($id);
        $menu->active = $menu->active == 1 ? 0 : 1;
        $menu->save();

        return redirect()->route('settings.menu.index');
    }
}
