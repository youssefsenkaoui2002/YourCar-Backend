<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    // Liste tous les magasins
    public function index()
    {
        $magasins =Magasin::all();
        return response()->json([
            "magasins" =>$magasins
        ]);
    }

    // Retourne un magasin spécifique
    public function show($id)
    {
        $magasin = Magasin::find($id);
        if (!$magasin) {
            return response()->json(['message' => 'Magasin non trouvé'], 404);
        }
        return response()->json($magasin, 200);
    }

    // Crée un magasin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'ville' => 'required|string',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
            "status" => 'required|string'
        ]);

        $magasin = Magasin::create($validated);
        return response()->json($magasin, 201);
    }

    // Met à jour un magasin
    public function update(Request $request, $id)
    {
        $magasin = Magasin::find($id);
        if (!$magasin) {
            return response()->json(['message' => 'Magasin non trouvé'], 404);
        }

        $validated = $request->validate([
            'nom' => 'string',
            'ville' => 'string',
            'phone' => 'string',
            'telephone' => 'string',
            "status" => 'string'
        ]);
        // dd($validated);
        $magasin->update($validated);
        return response()->json($magasin, 200);
    }

    // Supprime un magasin
    public function destroy($id)
    {
        $magasin = Magasin::find($id);
        if (!$magasin) {
            return response()->json(['message' => 'Magasin non trouvé'], 404);
        }

        $magasin->delete();
        return response()->json(['message' => 'Magasin supprimé'], 200);
    }
}
