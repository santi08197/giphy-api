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
        try{
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('AuthToken')->accessToken;
                
                $response = response()->json([
                    'token' => $token,
                    'expires_in' => now()->addMinutes(config('auth.guards.api.expire_in_minutes')),
                ]);
            }
        }catch(\Exception $e){
            $response = response()->json(['error' => 'Invalid credentials'], 401);
        }

        RequestLogController::saveRequestLog($request, $response, 'Login');

        return $response;
    }
}
