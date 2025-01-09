<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés.
     */
    public function index()
    {
        $employees = Employee::with('magasin', 'user')->get(); 
        return response()->json($employees);
    }

    /**
     * Afficher le formulaire pour créer un nouvel employé.
     */
    public function create()
    {
        return view('employees.insert');
    }

    /**
     * Enregistrer un nouvel employé dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_iduser' => 'required|exists:users,iduser',
            'magasin_idmagasin' => 'required|exists:magasin,idmagasin',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'poste' => 'required|string|max:100',
            'salaire' => 'required|numeric|min:0',
            'date_embauche' => 'required|date',
            'telephone' => 'required|string|max:15',
            'email' => 'required|string|email|max:150|unique:employees,email',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'message' => 'Employé créé avec succès.',
            'employee' => $employee,
        ]);
    }

    /**
     * Afficher un employé spécifique.
     */
    public function show($id)
    {
        $employee = Employee::with('magasin', 'user')->find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employé non trouvé.'], 404);
        }

        return response()->json($employee);
    }

    /**
     * Afficher le formulaire pour modifier un employé existant.
     */
    public function edit($id)
    {
        return view('employees.edit', compact('id'));
    }

    /**
     * Mettre à jour un employé existant dans la base de données.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_iduser' => 'sometimes|exists:users,iduser',
            'magasin_idmagasin' => 'sometimes|exists:magasin,idmagasin',
            'nom' => 'sometimes|string|max:100',
            'prenom' => 'sometimes|string|max:100',
            'poste' => 'sometimes|string|max:100',
            'salaire' => 'sometimes|numeric|min:0',
            'date_embauche' => 'sometimes|date',
            'telephone' => 'sometimes|string|max:15',
            'email' => 'sometimes|string|email|max:150|unique:employees,email,' . $id,
        ]);

        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employé non trouvé.'], 404);
        }

        $employee->update($validated);

        return response()->json([
            'message' => 'Employé mis à jour avec succès.',
            'employee' => $employee,
        ]);
    }

    /**
     * Supprimer un employé.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employé non trouvé.'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employé supprimé avec succès.']);
    }
}
