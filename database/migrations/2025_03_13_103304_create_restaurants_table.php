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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('nom_Restaurant');
            $table->string('adresse');
            $table->string('telephone');
            $table->double('notation')->nullable();
            $table->enum('status', ['accepted', 'rejected','En Attent'])->default('En Attent');
            $table->string('image');
            $table->string('zone_Livraison');
            $table->foreignId( 'user_created_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
