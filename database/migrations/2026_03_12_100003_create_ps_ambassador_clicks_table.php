<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ps_ambassador_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambassadeur_id')->constrained('ps_ambassadeurs')->cascadeOnDelete();
            // IP hashée (SHA-256) — RGPD : aucune donnée personnelle stockée en clair
            $table->string('ip_hash', 64)->nullable();
            $table->string('referer', 500)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ps_ambassador_clicks');
    }
};
