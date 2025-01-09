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
Route::middleware('chekrole:admin')->group(function () {


});
Route::middleware('chekrole:manager')->group(function () {


});
Route::middleware('chekrole:supermanager')->group(function () {


});
Route::middleware('chekrole:autre')->group(function () {


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







    // Routes accessibles uniquement aux utilisateurs avec rôle "user"
    Route::middleware('checkrole:user')->group(function () {
        // Routes pour les magasins
        Route::controller(MagasinController::class)->group(function () {
            Route::get('/magasins', 'index');
            Route::get('/magasins/{id}', 'show');
            Route::post('/magasins', 'store');
            Route::put('/magasins/{id}', 'update');
            Route::delete('/magasins/{id}', 'destroy');
        });

        // Routes pour les voitures
        Route::controller(VoitureController::class)->group(function () {
            Route::get('/voitures', 'index');
            Route::get('/voitures/{id}', 'show');
            Route::post('/voitures', 'store');
            Route::put('/voitures/{id}', 'update');
            Route::delete('/voitures/{id}', 'destroy');
        });

        // Routes pour les employés
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/employees', 'index');
            Route::get('/employees/{id}', 'show');
            Route::post('/employees', 'store');
            Route::put('/employees/{id}', 'update');
            Route::delete('/employees/{id}', 'destroy');
        });

        // Routes pour les clients
        Route::controller(ClientController::class)->group(function () {
            Route::get('/clients', 'index');
            Route::get('/clients/{id}', 'show');
            Route::post('/clients', 'store');
            Route::put('/clients/{id}', 'update');
            Route::delete('/clients/{id}', 'destroy');
        });

        // Routes pour les réservations
        Route::controller(ReservationController::class)->group(function () {
            Route::get('/reservations', 'index');
            Route::get('/reservations/{id}', 'show');
            Route::post('/reservations', 'store');
            Route::put('/reservations/{id}', 'update');
            Route::delete('/reservations/{id}', 'destroy');
        });

        // Routes pour les documents
        Route::controller(DocumentController::class)->group(function () {
            Route::get('/documents', 'index');
            Route::get('/documents/{id}', 'show');
            Route::post('/documents', 'store');
            Route::put('/documents/{id}', 'update');
            Route::delete('/documents/{id}', 'destroy');
        });
    });

    // Groupes pour rôles supplémentaires
    Route::middleware('checkrole:admin')->group(function () {
        // Ajoutez ici les routes spécifiques pour les administrateurs
    });

    Route::middleware('checkrole:manager')->group(function () {
        // Ajoutez ici les routes spécifiques pour les managers
    });

    Route::middleware('checkrole:supermanager')->group(function () {
        // Ajoutez ici les routes spécifiques pour les supermanagers
    });

    Route::middleware('checkrole:autre')->group(function () {
        // Ajoutez ici les routes spécifiques pour le rôle "autre"
    });
});
