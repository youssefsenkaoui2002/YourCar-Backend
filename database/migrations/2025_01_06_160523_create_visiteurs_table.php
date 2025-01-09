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
        // Schema::create('voitures', function (Blueprint $table) {
        //     $table->id('idvoitures'); // Clé primaire
        //     $table->string('VilleDepart');
        //     $table->string('VilleArrivee');
        //     $table->string('DateDepart');
        //     $table->string('DateArrivee');
        //     $table->timestamps();
        // });
        Schema::create('voitures', function (Blueprint $table) {
            $table->id('idvoitures'); // Clé primaire
            $table->string('marque');
            $table->string('modele');
            $table->integer('year');
            $table->foreignId('magasin_id')->constrained('magasins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
