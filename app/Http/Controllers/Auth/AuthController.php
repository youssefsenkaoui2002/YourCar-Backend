<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Enregistrement d'un utilisateur
    public function register(Request $request)
    {
        $validated = $request->validate([
            'UserName' => 'required|unique:users',
            'password' => 'required|min:6',
            'type' => 'required|in:0,1,2,3,4',
        ]);

        $user = User::create([
            'UserName' => $validated['UserName'],
            'password' => Hash::make($validated['password']),
            'type' => $validated['type'],
        ]);

        return response()->json(['message' => 'Utilisateur créé avec succès'], 201);
    }

    // Connexion d'un utilisateur
    public function login(Request $request)
    {
        $validated = $request->validate([
            'UserName' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('UserName', $validated['UserName'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        // Générer un token
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    // Déconnexion d'un utilisateur
    public function logout(Request $request)
    {
        $user = User::where('remember_token', $request->header('Authorization'))->first();

        if ($user) {
            $user->remember_token = null;
            $user->save();
            return response()->json(['message' => 'Déconnexion réussie'], 200);
        }

        return response()->json(['message' => 'Utilisateur non authentifié'], 401);
    }
}
