<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_checkins')) {
            return;
        }

        Schema::create('mentorship_checkins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pod_id')->constrained('mentorship_pods')->cascadeOnDelete();
            $table->foreignId('trainee_user_id')->constrained('users')->cascadeOnDelete();
            $table->date('week_start');
            $table->unsignedTinyInteger('progress_percent')->default(0);
            $table->text('blockers_text')->nullable();
            $table->text('next_actions_text')->nullable();
            $table->text('mentor_feedback_text')->nullable();
            $table->unsignedTinyInteger('confidence_level')->nullable();
            $table->enum('risk_flag', ['low', 'medium', 'high'])->default('low');
            $table->timestamps();

            $table->index(['pod_id', 'week_start']);
            $table->index(['trainee_user_id', 'week_start']);
            $table->unique(['pod_id', 'trainee_user_id', 'week_start'], 'mentorship_checkins_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_checkins');
    }
};
