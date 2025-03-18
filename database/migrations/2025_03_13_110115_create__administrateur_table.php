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
        DB::statement("CREATE TABLE administrateur (
            role_id BIGINT CHECK (role_id = 1)
        ) INHERITS (users);");
        DB::statement("ALTER TABLE administrateur ADD PRIMARY KEY (id)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_administrateur');
    }
};
