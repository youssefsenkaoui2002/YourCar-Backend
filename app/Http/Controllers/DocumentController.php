<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Afficher tous les documents.
     */
    public function index()
    {
        $documents = Document::with(['reservation', 'employee', 'user'])->get();
        return response()->json($documents);
    }

    /**
     * Créer un nouveau document.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_idreservation' => 'required|exists:reservations,idreservation',
            'reservation_employee_idemployee' => 'required|exists:employees,idemployee',
            'reservation_user_iduser' => 'required|exists:users,iduser',
            'type_document' => 'required|string',
            'chemin_fichier' => 'required|string',
            'nom_fichier' => 'required|string',
            'date_emission' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $document = Document::create($validated);

        return response()->json([
            'message' => 'Document créé avec succès.',
            'data' => $document,
        ], 201);
    }

    /**
     * Afficher un document spécifique.
     */
    public function show(Document $document)
    {
        $document->load(['reservation', 'employee', 'user']);
        return response()->json($document);
    }

    /**
     * Mettre à jour un document existant.
     */
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'reservation_idreservation' => 'required|exists:reservations,idreservation',
            'reservation_employee_idemployee' => 'required|exists:employees,idemployee',
            'reservation_user_iduser' => 'required|exists:users,iduser',
            'type_document' => 'required|string',
            'chemin_fichier' => 'required|string',
            'nom_fichier' => 'required|string',
            'date_emission' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $document->update($validated);

        return response()->json([
            'message' => 'Document mis à jour avec succès.',
            'data' => $document,
        ]);
    }

    /**
     * Supprimer un document.
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return response()->json([
            'message' => 'Document supprimé avec succès.',
        ]);
    }
}
