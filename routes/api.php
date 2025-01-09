<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DocumentController;

use App\Http\Controllers\Auth\AuthController;










/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('magasins', MagasinController::class);

Route::resource('voitures', VoitureController::class);



Route::apiResource('employees', EmployeeController::class);

Route::apiResource('clients', ClientController::class);

Route::apiResource('reservations', ReservationController::class);

Route::apiResource('documents', controller: DocumentController::class);



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.token')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Routes protégées
    Route::get('/profile', function (Request $request) {
        $user = \App\Models\User::where('remember_token', $request->header('Authorization'))->first();
        return response()->json($user);
    });
});




