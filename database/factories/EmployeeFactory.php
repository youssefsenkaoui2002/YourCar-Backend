<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Magasin;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_iduser' => User::factory(), // Générer un utilisateur lié
            'magasin_idmagasin' => Magasin::factory(),
        ];
    }
}
