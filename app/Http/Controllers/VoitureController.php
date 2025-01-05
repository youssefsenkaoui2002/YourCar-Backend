<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Afficher la liste des voitures.
     */
    public function index()
    {
        $voitures = Voiture::with('magasin')->get(); 
        return response()->json($voitures);
    }

    /**
     * Afficher le formulaire pour créer une nouvelle voiture.
     */
    public function create()
    {
        return view('voitures.insert');
    }

    /**
     * Enregistrer une nouvelle voiture dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'magasin_id' => 'required|exists:magasins,id',
        ]);

        $voiture = Voiture::create($validated);

        return response()->json([
            'message' => 'Voiture créée avec succès.',
            'voiture' => $voiture,
        ]);
    }

    /**
     * Afficher une voiture spécifique.
     */
    public function show($id)
    {
        $voiture = Voiture::with('magasin')->find($id);

        if (!$voiture) {
            return response()->json(['message' => 'Voiture non trouvée.'], 404);
        }

        return response()->json($voiture);
    }

    /**
     * Afficher le formulaire pour modifier une voiture existante.
     */
    public function edit($id)
    {
        return view('voitures.edit', compact('id'));
    }

    /**
     * Mettre à jour une voiture existante dans la base de données.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'marque' => 'sometimes|string|max:255',
            'modele' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|digits:4',
            'magasin_id' => 'sometimes|exists:magasins,id',
        ]);

        $voiture = Voiture::find($id);

        if (!$voiture) {
            return response()->json(['message' => 'Voiture non trouvée.'], 404);
        }

        $voiture->update($validated);

        return response()->json([
            'message' => 'Voiture mise à jour avec succès.',
            'voiture' => $voiture,
        ]);
    }

    /**
     * Supprimer une voiture.
     */
    public function destroy($id)
    {
        $voiture = Voiture::find($id);

        if (!$voiture) {
            return response()->json(['message' => 'Voiture non trouvée.'], 404);
        }

        $voiture->delete();

        return response()->json(['message' => 'Voiture supprimée avec succès.']);
    }
}
