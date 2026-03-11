<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_module_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('formation_enrollments')->cascadeOnDelete();
            $table->foreignId('module_id')->constrained('formation_modules')->cascadeOnDelete();
            $table->string('status')->default('locked');     // locked|available|in_progress|completed
            $table->unsignedTinyInteger('completion_pct')->default(0); // 0-100
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('activity_checks')->nullable();     // activités cochées {"tableau_viz": true, ...}
            $table->timestamps();

            $table->unique(['enrollment_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_module_progress');
    }
};
