<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_modules', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();                // ex: 01-je-me-rencontre
            $table->string('title');                         // Titre affiché
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('order')->default(0);
            $table->string('week_label')->nullable();        // ex: Semaine 1
            $table->boolean('is_active')->default(true);
            $table->json('activities')->nullable();          // liste des activités
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_modules');
    }
};
