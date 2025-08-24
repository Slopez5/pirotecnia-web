<?php

namespace App\Http\Controllers\API;

use App\Helper\FirebaseService;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::find(Auth::user()->id);
            $token = $user->createToken('access_token')->accessToken;
            $data = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->success($data, 200);
        } else {
            return response()->json([
                'error' => 'Invalid credentials',
            ], 401);
        }
    }

    // Register
    public function register(Request $request) {}

    // Recovery
    public function recovery(Request $request) {}

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->success([
            'message' => 'Successfully logged out',
        ]);
    }

    public function saveFCMToken(Request $request)
    {
        logger($request->all());
        $user = Auth::user();
        $user->fcm_token = $request->input('fcm_token');
        $user->save();

        return response()->success([
            'message' => 'FCM token saved successfully',
        ], 200);
    }

    public function testFirebase()
    {
        $firebaseService = new FirebaseService;
        $accessToken = $firebaseService->sendMessage(
            'cAyzVSqTT0kfrtjoFKQctq:APA91bEzA6YjIG5QvCzHsSXii_5OB6dvABetSE6tFykgtp_QyTmvTSrHs0EEzjdwvDCqTnXQdvb4v6DXwgDPfOgDdmRmdhFohXVXOa5XQ1bhzuM8kEQcO2g',
            [
                'title' => 'Pirotecnia San Rafael',
                'body' => 'El Ranchito Michoacan - 26/08/2025',
            ],
            [
                'id' => 1,
                'name' => 'Evento',
            ]
        );

        return response()->json(['access_token' => $accessToken]);
    }

    public function importFromEmployees()
    {
        $employees = Employee::all();
        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'No employees found',
            ], 404);
        }

        foreach ($employees as $employee) {
            $user = User::where('email', $employee->email)->first();
            if (! $user) {
                $user = new User;
                $user->name = $employee->name;
                $user->email = $employee->email;
                $user->phone = $employee->phone;
                $user->role_id = 3;
                $user->password = bcrypt('12345678');
                $user->save();
            }
        }

        return response()->success($employees, 200);
    }
}
