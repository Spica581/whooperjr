<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInformation;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'StudentNo' => 'required|string',
            'Password'  => 'required|string'
        ]);

        $user = GeneralInformation::where('StudentNo', $request->StudentNo)->first();

        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $user
        ]);
    }

    public function me(Request $request)
    {
        return response()->json(['success' => true, 'data' => $request->user()]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logged out.']);
    }
}