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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('iddocument'); // Clé primaire
            $table->unsignedBigInteger('reservation_idreservation'); // FK vers reservations
            $table->unsignedBigInteger('reservation_employee_idemployee'); // FK vers employees
            $table->unsignedBigInteger('reservation_user_iduser'); // FK vers users
            $table->timestamps();

            // Contraintes de clés étrangères
            $table->foreign('reservation_idreservation')->references('idreservation')->on('reservations')->onDelete('cascade');
            $table->foreign('reservation_employee_idemployee')->references('idemployee')->on('employees')->onDelete('cascade');
            $table->foreign('reservation_user_iduser')->references('iduser')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};