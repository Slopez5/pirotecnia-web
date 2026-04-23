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
        $employees = Employee::with('experienceLevel')
            ->orderBy('name')
            ->get();
        $itemActive = 3;

        return view('panel.employees.index', compact('employees', 'itemActive'));
    }

    public function createEmployee()
    {
        $experienceLevels = ExperienceLevel::orderBy('name')->get();

        return view('panel.employees.create', compact('experienceLevels'));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'experience_level' => 'required|exists:experience_levels,id',
            'salary' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address ?: '';
        $employee->salary = $this->normalizeAmount((string) $request->salary);

        if ($request->experience_level != '') {
            $employee->experienceLevel()->associate($request->experience_level);
        }
        $employee->save();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/employees/'.$employee->id, $fileName);
            $employee->photo = $fileName;
            $employee->save();
        }

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

    private function normalizeAmount(string $value): string
    {
        $normalized = preg_replace('/[^0-9\-\.,]/', '', trim($value));

        if ($normalized === null || $normalized === '' || $normalized === '-') {
            return '0';
        }

        return (string) ((float) str_replace(',', '', $normalized));
    }
}
