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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Route::apiResource('magasins', MagasinController::class);

// Route::resource('voitures', VoitureController::class);

// Route::apiResource('employees', EmployeeController::class);

// Route::apiResource('clients', ClientController::class);

// Route::apiResource('reservations', ReservationController::class);

// Route::apiResource('documents', controller: DocumentController::class);




Route::middleware('chekrole:user')->group(function () {
    Route::controller(MagasinController::class)->group(function(){
        Route::get('/magasins','index');
        Route::get('/magasin/show/{id}', 'show');
        Route::post('/magasin/store', 'store');
        Route::put('/magasin/update/{id}', 'update');
        Route::delete('/magasin/delete/{id}', 'destroy');
    });

});
Route::middleware('chekrole:admin')->group(function () {


});
Route::middleware('chekrole:manager')->group(function () {


});
Route::middleware('chekrole:supermanager')->group(function () {


});
Route::middleware('chekrole:autre')->group(function () {


});






