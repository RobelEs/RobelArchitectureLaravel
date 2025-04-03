<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chantier>
 */
class ChantierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company, // Nom aléatoire d'entreprise
            'adresse' => $this->faker->address, // Adresse aléatoire
            'date_debut' => $this->faker->date(), // Date aléatoire
            'date_fin' => $this->faker->optional()->date(), // Parfois null
        ];
    }
}
