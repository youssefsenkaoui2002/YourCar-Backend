<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('idemployee'); // Clé primaire
            $table->unsignedBigInteger('user_iduser'); // FK vers users
            $table->unsignedBigInteger('magasin_idmagasin'); // FK vers magasin
            $table->string('nom', 100); // Nom de l'employé
            $table->string('prenom', 100); // Prénom de l'employé
            $table->string('poste', 100); // Poste de l'employé
            $table->decimal('salaire', 10, 2); // Salaire de l'employé
            $table->date('date_embauche'); // Date d'embauche
            $table->string('telephone', 15); // Téléphone de l'employé
            $table->string('email', 150)->unique(); // Email de l'employé
            $table->timestamps();

            // Contraintes de clés étrangères
            $table->foreign('user_iduser')->references('iduser')->on('users')->onDelete('cascade');
            $table->foreign('magasin_idmagasin')->references('idmagasin')->on('magasin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
