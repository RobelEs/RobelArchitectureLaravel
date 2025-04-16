<?php

namespace App\Http\Services;

use App\Models\Roles;
use Illuminate\Http\Request;

class RoleService
{
    /**
     * Récupère tous les rôles.
     */
    public function getAll()
    {
        return Roles::all();
    }

    /**
     * Récupère un rôle par son ID.
     */
    public function getById($id)
    {
        return Roles::findOrFail($id);
    }

    /**
     * Crée un nouveau rôle.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        return Roles::create($validated);
    }

    /**
     * Met à jour un rôle existant.
     */
    public function update(Request $request, $id)
    {
        $role = Roles::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:roles,name,' . $id,
        ]);

        $role->update($validated);

        return $role;
    }

    /**
     * Supprime un rôle.
     */
    public function destroy($id)

    {
        $role = Roles::findOrFail($id);
        $role->delete();
    }
}