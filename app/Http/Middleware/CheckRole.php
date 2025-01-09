<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CheckRole
{

    public function handle(Request $request, Closure $next , $typeUser)
    {
        $token = $request->header('X-Custom-Token');

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken) {
                $user = $accessToken->tokenable;
                Auth::login($user);
            }
        }

        if(Auth::check() &&  auth()->user()->type == $typeUser){
            return $next($request);
        }

        return response()->json(['You do not have permission to access for this page.']);

    }

}
