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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('date');
            $table->time('time');
            $table->unsignedInteger('guests');
            $table->text('special_requests')->nullable();
            $table->boolean('preorder_check')->default(false);
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->enum('status', ['En attente de confirmation', 'Confirmée', 'Annulée', 'Terminée'])->default('En attente de confirmation');
            $table->foreignId('user_id')->constrained('users');
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
