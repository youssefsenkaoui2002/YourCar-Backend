<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Affiche la liste des clients.
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Crée un nouveau client.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'user_iduser' => 'required|exists:users,iduser',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|max:150|unique:clients,email',
            'date_naissance' => 'nullable|date',
            'ville' => 'nullable|string|max:100',
        ]);

        // Création du client
        $client = Client::create($validated);
        return response()->json(['message' => 'Client ajouté avec succès.', 'data' => $client], 201);
    }

    /**
     * Affiche les détails d'un client spécifique.
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Met à jour les informations d'un client.
     */
    public function update(Request $request, Client $client)
    {
        // Validation des données
        $validated = $request->validate([
            'user_iduser' => 'required|exists:users,iduser',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|max:150|unique:clients,email,' . $client->idclient,
            'date_naissance' => 'nullable|date',
            'ville' => 'nullable|string|max:100',
        ]);

        // Mise à jour du client
        $client->update($validated);
        return response()->json(['message' => 'Client mis à jour avec succès.', 'data' => $client]);
    }

    /**
     * Supprime un client.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client supprimé avec succès.']);
    }
}
