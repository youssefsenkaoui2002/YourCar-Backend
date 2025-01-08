<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Afficher toutes les réservations
    public function index()
    {
        $reservations = Reservation::with(['employee', 'user', 'voiture'])->get();
        return response()->json($reservations);
    }

    // Ajouter une nouvelle réservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_idemployee' => 'required|exists:employees,idemployee',
            'user_iduser' => 'required|exists:users,iduser',
            'voitures_idvoitures' => 'required|exists:voitures,idvoitures',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'montant_total' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);
        return response()->json(['message' => 'Réservation créée avec succès.', 'data' => $reservation], 201);
    }

    // Afficher une réservation spécifique
    public function show(Reservation $reservation)
    {
        $reservation->load(['employee', 'user', 'voiture']);
        return response()->json($reservation);
    }

    // Mettre à jour une réservation existante
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'employee_idemployee' => 'required|exists:employees,idemployee',
            'user_iduser' => 'required|exists:users,iduser',
            'voitures_idvoitures' => 'required|exists:voitures,idvoitures',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'montant_total' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($validated);
        return response()->json(['message' => 'Réservation mise à jour avec succès.', 'data' => $reservation]);
    }

    // Supprimer une réservation
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Réservation supprimée avec succès.']);
    }
}
