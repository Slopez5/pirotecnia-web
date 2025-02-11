<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    // Login
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::find(Auth::user()->id);
            $token = $user->createToken('access_token')->accessToken;
            $data = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json($data, 200);
        } else {
            return response()->json([
                'error' => 'Invalid credentials'
            ], 401);
        }
    }

    // Register
    public function register(Request $request) {

    }

    // Recovery
    public function recovery(Request $request) {}

    public function logout(Request $request) {}
}
