<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
             ...$request->validated(),
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
public function login(LoginRequest $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
    }
    $user = Auth::user();
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
