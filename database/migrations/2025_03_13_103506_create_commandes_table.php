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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'annulee']);
            $table->integer('quantite'); 
            $table->text('instructions')->nullable(); 
            $table->double('evaluation')->nullable();
            $table->double('prixTotal', 8, 2);
            $table->foreignId('cleint_id')->constrained('users');
            $table->foreignId('livreur_id')->constrained('users');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
