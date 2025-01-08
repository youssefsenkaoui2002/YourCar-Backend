<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // Ajouter le Seeder des utilisateurs
        ]);

        $this->call([
            MagasinSeeder::class, // Ajouter le Seeder des magasins
        ]);

        $this->call([
            UserSeeder::class,       // Générer des utilisateurs
            MagasinSeeder::class,    // Générer des magasins
            EmployeeSeeder::class,   // Générer des employés
        ]);

        $this->call([
                UserSeeder::class,       // Générer des utilisateurs
                ClientSeeder::class,     // Générer des clients
            ]);
    
    }
}
