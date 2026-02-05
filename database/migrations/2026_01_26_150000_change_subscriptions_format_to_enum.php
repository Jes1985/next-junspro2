<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * V2 — Contrainte stricte : format = visio | presentiel | mixte uniquement.
     */
    public function up(): void
    {
        // MySQL : modifier la colonne en ENUM
        DB::statement("ALTER TABLE subscriptions MODIFY COLUMN format ENUM('visio', 'presentiel', 'mixte') NOT NULL DEFAULT 'visio'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('format', 20)->default('visio')->change();
        });
    }
};
