<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chantier;
use App\Models\Materiel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)->create();
        Chantier::factory()->count(10)->create([
            'client_id' => $users->random()->id,
        ]);

        // Génération de matériels aléatoires
        Materiel::factory()->count(20)->create();
    }
}
