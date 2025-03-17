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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id('id'); 
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade'); 
            $table->double('montant', 8, 2); 
            $table->enum('type', ['carte', 'paypal', 'virement']); 
            $table->enum('statut', ['en_attente', 'valide', 'rembourse']);
            $table->string('reference')->unique();
            $table->dateTime('dateTransaction')->default(now()); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
