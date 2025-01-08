<?php

namespace Database\Factories;

use App\Models\Magasin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Magasin>
 */
class MagasinFactory extends Factory
{
    protected $model = Magasin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'nom' => $this->faker->company(), // Nom du magasin aléatoire
            'adresse' => $this->faker->address(), // Adresse aléatoire
        ];
    }
}
