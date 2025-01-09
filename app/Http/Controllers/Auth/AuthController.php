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
        try {
            $validated = $request->validate([
                'UserName' => 'required|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            $user = User::create([
                'UserName' => $validated['UserName'],
                'password' => Hash::make($validated['password'])
            ]);

            return response()->json(['message' => 'Utilisateur créé avec succès'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue lors de la création de l\'utilisateur :',$e->getMessage()], 500);
        }

    }

    // Connexion d'un utilisateur
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'UserName' => 'required',
                'password' => 'required',
            ]);

            $account = $request->only('UserName', 'password');

            if (!auth()->attempt($account)) {
                return response()->json(['message' => 'Identifiants invalides'], 401);
            }


            $user = User::where('UserName', $validated['UserName'])->first();
            // Générer un token
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            // $token = Str::random(60);
            // $user->remember_token = $token;
            // $user->save();

            return response()->json([
                'message' => 'Utilisateur créé avec succès',
                'token' => $token,
                'user' => $user,

            ]);
        }
         catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue lors de la connexion de l\'utilisateur :',$e->getMessage()], 500);
        }
    }

    // Déconnexion d'un utilisateur
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return response()->json(['message' => 'Déconnecté avec succès'], 200);
            }
            return response()->json(['message' => 'Impossible de se déconnecter'], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur est survenue lors de la déconnexion de l\'utilisateur :',$e->getMessage()], 500);
        }

    }
}
