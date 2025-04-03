<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChantierResource extends JsonResource
{
    public function toArray($request)
    {
        // Transformation des données du modèle Chantier avant de les envoyer en réponse JSON
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'adresse' => $this->adresse,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
        ];
    }
}
