<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->accessToken;
            
            return response()->json([
                'token' => $token,
                'expires_in' => now()->addMinutes(config('auth.guards.api.expire_in_minutes')),
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
