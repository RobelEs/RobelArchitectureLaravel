<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterielResource extends JsonResource
{
    /**
     * Transforme les données du modèle Materiel pour la réponse JSON.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'quantite_disponible' => $this->quantite_disponible,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}