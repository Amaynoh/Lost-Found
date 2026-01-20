<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message' => 'Inscription réussie',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

     public function login(Request $request)
    {
        if (!Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user'  => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }
}
