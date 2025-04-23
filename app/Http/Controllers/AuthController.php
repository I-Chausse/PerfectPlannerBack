<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Error;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only("email", "password");
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken("auth_token")->plainTextToken;
                $role_code = $user->role()->first()->code;
                return response()->json(
                    ["token" => $token, "role" => $role_code],
                    200
                );
            }
            return response()->json(["message" => "Unauthorized"], 401);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(["message" => "Logged out successfully"], 200);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
?>
