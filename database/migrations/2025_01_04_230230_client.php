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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('Name',50);
            $table->string('lName',50);
            $table->string('adress',255);
            $table->string('phone',15);
            $table->string('CIN',10);
            $table->string('NumP',9);
            $table->date('DateBirth');
            $table->string('city', 100);
            $table->email('email')->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
