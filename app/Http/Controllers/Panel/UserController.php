<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::where('role_id', 2)
        ->where('id', '!=', auth()->user()->id)
        ->get();
        $itemActive = 2;
        return view('panel.users.index', compact('users', 'itemActive'));
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => 2,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('panel.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('panel.users.show', compact('user'));
    }
}
