<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    /**
     * La relation many-to-many avec le modèle Employe.
     */
    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'chantier_employe');
    }
}
