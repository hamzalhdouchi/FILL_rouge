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
        Schema::create('plats', function (Blueprint $table) {
            $table->id();
            $table->string('nom_plat');
            $table->string('desciption');
            $table->double('prix',8,2);
            $table->integer('temps_Preparation');
            $table->boolean('disponible')->default(1);
            $table->string('image');
            $table->foreignId('categorie_id')->constrained('categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plats');
    }
};
