<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', // Assure-toi que ces champs correspondent aux colonnes de ta table
        'prenom',
        'poste',
    ];

    /**
     * La table associée au modèle (si le nom ne suit pas la convention de Laravel).
     *
     * @var string
     */
    protected $table = 'employes'; // Facultatif, si la table suit la convention de nommage (employes -> Employe)
}
