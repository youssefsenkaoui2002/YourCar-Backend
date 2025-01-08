<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DocumentController;









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




