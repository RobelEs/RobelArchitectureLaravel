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
            'name' => $this->name,
            'location' => $this->location,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
