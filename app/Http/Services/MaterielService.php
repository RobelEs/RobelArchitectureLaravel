<?php

namespace App\Http\Services;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielService
{
    /**
     * Récupère tous les matériels.
     */
    public function getMateriels()
    {
        try {
            return Materiel::all();
        } catch (\Exception $e) {
            throw $e;
        }
        // return Materiel::all();
    }

    /**
     * Récupère un matériel par son ID.
     */
    public function getMaterielById(string $id)
    {
        return Materiel::findOrFail($id);
    }

    /**
     * Crée un nouveau matériel.
     */
    public function storeMateriel(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'quantite_disponible' => 'required|integer|min:1',
        ]);

        return Materiel::create($validatedData);
    }

    /**
     * Met à jour un matériel existant.
     */
    public function updateMateriel(Request $request, string $id)
    {
        $materiel = Materiel::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'quantite_disponible' => 'sometimes|required|integer|min:1',
        ]);

        $materiel->update($validatedData);

        return $materiel;
    }

    /**
     * Supprime un matériel.
     */
    public function deleteMateriel(string $id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();
    }
}