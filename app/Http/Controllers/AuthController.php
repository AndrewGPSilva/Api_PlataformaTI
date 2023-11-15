<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken();

            return response()->json([
                'token' => $token->accessToken,
            ]);
        }

        return response()->json([
            'error' => 'Invalid credentials.',
        ], 401);
    }
}
