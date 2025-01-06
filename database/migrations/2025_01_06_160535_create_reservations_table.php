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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('idreservation'); // Clé primaire
            $table->unsignedBigInteger('employee_idemployee'); // FK vers employees
            $table->unsignedBigInteger('user_iduser'); // FK vers users
            $table->unsignedBigInteger('voitures_idvoitures'); // FK vers voitures
            $table->timestamps();

            // Contraintes de clés étrangères
            $table->foreign('employee_idemployee')->references('idemployee')->on('employees')->onDelete('cascade');
            $table->foreign('user_iduser')->references('iduser')->on('users')->onDelete('cascade');
            $table->foreign('voitures_idvoitures')->references('idvoitures')->on('voitures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
