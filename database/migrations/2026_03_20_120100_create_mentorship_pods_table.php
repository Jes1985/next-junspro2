<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_pods')) {
            return;
        }

        Schema::create('mentorship_pods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('sector', 120)->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('max_trainees')->default(3);
            $table->unsignedTinyInteger('active_trainees_count')->default(0);
            $table->enum('visibility', ['public', 'private', 'school_only'])->default('public');
            $table->enum('status', ['draft', 'open', 'full', 'paused', 'closed'])->default('draft');
            $table->enum('premium_label', ['standard', 'curated', 'elite'])->default('standard');
            $table->timestamps();

            $table->index(['mentor_user_id', 'status']);
            $table->index(['status', 'visibility']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_pods');
    }
};
