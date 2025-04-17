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
            'name' => $this->faker->company, // Nom aléatoire d'entreprise
            'address' => $this->faker->address, // Adresse aléatoire
            'start_date' => $this->faker->date(), // Date aléatoire
            'end_date' => $this->faker->optional()->date(), // Parfois null
        ];
    }
}
