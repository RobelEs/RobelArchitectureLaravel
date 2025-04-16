<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * La table associée au modèle (si le nom ne suit pas la convention de Laravel).
     *
     * @var string
     */
    protected $table = 'roles'; // Facultatif si la table suit la convention

    /**
     * Les relations ou autres méthodes spécifiques au modèle peuvent être ajoutées ici.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
