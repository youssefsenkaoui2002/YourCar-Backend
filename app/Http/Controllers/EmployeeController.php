<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        // Charger les employés avec leurs relations
        $employees = Employee::with(['user', 'magasin'])->get();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'user_iduser' => 'required|exists:users,iduser',
            'magasin_idmagasin' => 'required|exists:magasin,idmagasin',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'poste' => 'required|string|max:100',
            'salaire' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|max:150|unique:employees,email',
        ]);

        // Création de l'employé
        $employee = Employee::create($validated);
        return response()->json(['message' => 'Employé ajouté avec succès.', 'data' => $employee], 201);
    }

    public function show(Employee $employee)
    {
        // Charger les relations pour l'employé
        $employee->load(['user', 'magasin']);
        return response()->json($employee);
    }

    public function update(Request $request, Employee $employee)
    {
        // Validation des données
        $validated = $request->validate([
            'user_iduser' => 'required|exists:users,iduser',
            'magasin_idmagasin' => 'required|exists:magasin,idmagasin',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'poste' => 'required|string|max:100',
            'salaire' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|max:150|unique:employees,email,' . $employee->idemployee,
        ]);

        // Mise à jour de l'employé
        $employee->update($validated);
        return response()->json(['message' => 'Employé mis à jour avec succès.', 'data' => $employee]);
    }

    public function destroy(Employee $employee)
    {
        // Suppression de l'employé
        $employee->delete();
        return response()->json(['message' => 'Employé supprimé avec succès.']);
    }
}
