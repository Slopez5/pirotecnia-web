<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExperienceLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $users = User::where('role_id', 2)
            ->where('id', '!=', $user->id)
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

    public function indexEmployees()
    {
        $employees = Employee::all();
        $itemActive = 3;
        return view('panel.employees.index', compact('employees', 'itemActive'));
    }

    public function createEmployee()
    {
        $experienceLevels = ExperienceLevel::all();
        return view('panel.employees.create', compact('experienceLevels'));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'experience_level' => 'required',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        if ($request->address) {
            $employee->address = $request->address;
        } else {
            $employee->address = "";
        }
        if ($request->salary) {
            $employee->salary = $request->salary;
        } else {
            $employee->salary = 0;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            // save to storage/app/public/employee_id/image_profile.jpg
            $file->storeAs('public/employees/' . $employee->id, $fileName);
            $employee->image = $fileName;
        }
        if ($request->experience_level != "") {
            $employee->experienceLevel()->associate($request->experience_level);
        }
        $employee->save();
        return redirect()->route('employees.index');
    }

    public function editEmployee($id)
    {
        $employee = Employee::find($id);
        return view('panel.employees.edit', compact('employee'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = bcrypt($request->password);
        $employee->save();

        return redirect()->route('employees.index');
    }

    public function destroyEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function showEmployee($id)
    {
        $employee = Employee::find($id);
        return view('panel.employees.show', compact('employee'));
    }
}
