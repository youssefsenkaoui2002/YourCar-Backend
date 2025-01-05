<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

class AuthController extends Controller
{

    public function register(Request $req){

        $validated = $req->validate([
            'UserName' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'Name'=>'required|string|max:50',
            'lName'=>'required|string|max:50',
            'adress'=>'required|string|max:255',
            'phone'=>'required|string|max:15',
            'city'=>'required|string|max:100',
            'CIN'=>'required|string|max:10',
            'NumP'=>'required|string|max:9',
            'DateBirth'=>'required|date',
            'email'=>'required|email|unique:client,email',
        ]);

        User::create([
            'UserName' => $validated->UserName,
            'password' => Hash::make($validated->password),
        ]);

        Client::create([
            'Name'=>$validated->Name,
            'lName'=>$validated->lName,
            'adress'=>$validated->adress,
            'phone'=>$validated->phone,
            'city'=>$validated->city,
            'CIN'=>$validated->CIN,
            'NumP'=>$validated->NumP,
            'DateBirth'=>$validated->DateBith,
            'email'=>$validated->email,
        ]);

        return response()->json([
            'message'=>'Client created with his account successfully'
        ]);
    }

    public function login(Request $req){
        $validated = $req->validate([
            'UserName' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        $credentials = $req->only('UserName','password');

        if(auth()->attempt($credentials)){
            $user = User::all();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'message' => 'User authenticated successfully',
                'user' =>$user,
                'token' =>$token
            ]);
        };

        return response()->json([
            'message' => 'authentication feild'
        ]);
    }
}
