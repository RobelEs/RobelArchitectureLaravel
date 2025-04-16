<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'start_date',
        'end_date',
    ];
    /**
     * La relation many-to-many avec le modèle Employe.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,"chantier_employe", "chantier_id", "employe_id");
    }
}
