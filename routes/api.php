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

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
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

    Route::controller(VoitureController::class)->group(function(){
        Route::get('/voitures','index');
        Route::get('/voitures/show/{id}', 'show');
        Route::post('/voitures/store', 'store');
        Route::put('/voitures/update/{id}', 'update');
        Route::delete('/voitures/delete/{id}', 'destroy');
    });

});



Route::middleware('chekrole:commercial')->group(function () {
    Route::controller(MagasinController::class)->group(function(){
        Route::get('/magasins','index');
        Route::get('/magasin/show/{id}', 'show');
    });

    Route::controller(VoitureController::class)->group(function(){
        Route::get('/voitures','index');
        Route::get('/voitures/show/{id}', 'show');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index');
        Route::get('/clients/{id}', 'show');
        Route::post('/clients', 'store');
        Route::put('/clients/{id}', 'update');
        Route::delete('/clients/{id}', 'destroy');
    });
});



Route::middleware('chekrole:manager')->group(function () {
    Route::controller(MagasinController::class)->group(function(){
        Route::get('/magasins','index');
        Route::get('/magasin/show/{id}', 'show');
    });

    Route::controller(VoitureController::class)->group(function(){
        Route::get('/voitures','index');
        Route::get('/voitures/show/{id}', 'show');
        Route::post('/voitures/store', 'store');
        Route::put('/voitures/update/{id}', 'update');
        Route::delete('/voitures/delete/{id}', 'destroy');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index');
        Route::get('/employees/{id}', 'show');
        Route::post('/employees', 'store');
        Route::put('/employees/{id}', 'update');
        Route::delete('/employees/{id}', 'destroy');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index');
        Route::get('/clients/{id}', 'show');
        Route::post('/clients', 'store');
        Route::put('/clients/{id}', 'update');
        Route::delete('/clients/{id}', 'destroy');
    });
});



Route::middleware('chekrole:supermanager')->group(function () {

    Route::controller(MagasinController::class)->group(function(){
        Route::get('/magasins','index');
        Route::get('/magasin/show/{id}', 'show');
        Route::post('/magasin/store', 'store');
        Route::put('/magasin/update/{id}', 'update');
        Route::delete('/magasin/delete/{id}', 'destroy');
    });

    Route::controller(VoitureController::class)->group(function(){
        Route::get('/voitures','index');
        Route::get('/voitures/show/{id}', 'show');
        Route::post('/voitures/store', 'store');
        Route::put('/voitures/update/{id}', 'update');
        Route::delete('/voitures/delete/{id}', 'destroy');
    });

    Route::controller(ReservationController::class)->group(function(){
        Route::get('/reservations','index');
        Route::get('/reservations/show/{reservation}', 'show');
        Route::post('/reservations/store', 'store');
        Route::put('/reservations/update/{reservation}', 'update');
        Route::delete('/reservations/delete/{reservation}', 'destroy');
    });

    Route::controller(DocumentController::class)->group(function(){
        Route::get('/documents','index');
        Route::get('/documents/show/{document}', 'show');
        Route::post('/documents/store', 'store');
        Route::put('/documents/update/{document}', 'update');
        Route::delete('/documents/delete/{document}', 'destroy');
    });
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index');
        Route::get('/employees/{id}', 'show');
        Route::post('/employees', 'store');
        Route::put('/employees/{id}', 'update');
        Route::delete('/employees/{id}', 'destroy');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index');
        Route::get('/clients/{id}', 'show');
        Route::post('/clients', 'store');
        Route::put('/clients/{id}', 'update');
        Route::delete('/clients/{id}', 'destroy');
    });
});



















