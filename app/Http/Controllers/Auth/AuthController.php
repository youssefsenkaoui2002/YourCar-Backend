<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;



class AuthController extends Controller
{
    // Enregistrement d'un utilisateur
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'UserName' => 'required|unique:users',
                'password' => 'required|min:8|confirmed',
                'nom' => 'required|string|max:100',
                'prenom' => 'required|string|max:100',
                'adresse' => 'required|string|max:255',
                'telephone' => 'required|string|max:15',
                'email' => 'required|string|email|max:150|unique:clients',
                'date_naissance' => 'nullable|date',
                'ville' => 'nullable|string|max:100',
            ]);
            $client = Client::create([
                'user_iduser' => $user->id,
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'adresse' => $validated['adresse'],
                'telephone' => $validated['telephone'],
                'email' => $validated['email'],
                'date_naissance' => $validated['date_naissance'],
                'ville' => $validated['ville'],
            ]);

            $user = User::create([
                'UserName' => $validated['UserName'],
                'password' => Hash::make($validated['password'])
            ]);

            return response()->json(['message' => 'Client créé avec succès'], 201);
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
                'role' => $user->type

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
