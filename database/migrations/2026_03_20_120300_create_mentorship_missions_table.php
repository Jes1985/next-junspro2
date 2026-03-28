<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_missions')) {
            return;
        }

        Schema::create('mentorship_missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pod_id')->constrained('mentorship_pods')->cascadeOnDelete();
            $table->string('title');
            $table->text('brief')->nullable();
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->unsignedInteger('estimated_hours')->default(0);
            $table->date('due_date')->nullable();
            $table->enum('status', ['draft', 'published', 'in_progress', 'completed', 'archived'])->default('draft');
            $table->timestamps();

            $table->index(['pod_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_missions');
    }
};
