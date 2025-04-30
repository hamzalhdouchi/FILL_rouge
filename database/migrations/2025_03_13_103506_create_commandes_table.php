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
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'annulee'])->default('en_attente');
            $table->enum('paymentStatus', ['payer', 'en_cours'])->default('en_cours');
            $table->enum('CommandStatus', ['livraison', 'aTable']); 
            $table->enum('action', ['accepte', 'refusé'])->nullable();
            $table->integer('quantite');
            $table->text('instructions')->nullable();
            $table->double('evaluation')->nullable();
            $table->double('prixTotal', 8, 2)->nullable();
            $table->integer('table_number')->nullable();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->foreignId('livreur_id')->nullable()->constrained('users')->onDelete('cascade');
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
