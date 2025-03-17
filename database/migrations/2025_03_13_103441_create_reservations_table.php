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
            $table->id();
            $table->id('idReservation');
            $table->dateTime('dateHeure');
            $table->integer('duree');
            $table->enum('statut', ['en_attente', 'confirmee', 'annulee']); 
            $table->integer('nombrePersonnes');
            $table->foreignId('idTable')->constrained('tables')->onDelete('cascade'); 
            $table->timestamps();
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
