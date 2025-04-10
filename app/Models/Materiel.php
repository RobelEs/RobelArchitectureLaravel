<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'quantite_disponible',
    ];

    /**
     * La table associée au modèle (si le nom ne suit pas la convention de Laravel).
     *
     * @var string
     */
    protected $table = 'materiels'; // Facultatif si la table suit la convention
}
