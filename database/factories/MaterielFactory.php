<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materiel>
 */
class MaterielFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word, // Nom aléatoire
            'quantite_disponible' => $this->faker->numberBetween(1, 100), // Quantité aléatoire entre 1 et 100
        ];
    }
}