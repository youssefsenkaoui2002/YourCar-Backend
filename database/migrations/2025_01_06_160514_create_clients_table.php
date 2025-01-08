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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('idclient'); // Clé primaire
            $table->unsignedBigInteger('user_iduser'); // FK vers users
            $table->string('nom', 100); // Nom du client
            $table->string('prenom', 100); // Prénom du client
            $table->string('adresse', 255); // Adresse du client
            $table->string('telephone', 15); // Numéro de téléphone
            $table->string('email', 150)->unique(); // Email unique
            $table->date('date_naissance')->nullable(); // Date de naissance
            $table->string('ville', 100)->nullable(); // Ville de résidence
            $table->timestamps();

            // Contraintes de clé étrangère
            $table->foreign('user_iduser')->references('iduser')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
