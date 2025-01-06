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
