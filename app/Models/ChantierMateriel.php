<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierMateriel extends Model
{
    use HasFactory;

    /**
     * Indique si le modèle utilise des timestamps.
     *
     * @var bool
     */
    public $timestamps = true; // Assure-toi que cette valeur est correcte en fonction de ta table

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'chantier_materiel'; // Spécifie le nom de la table pivot

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chantier_id', // Assurez-vous que ces champs correspondent aux colonnes de votre table
        'materiel_id',
        'quantite_utilisee',
    ];
}
