<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_submissions')) {
            return;
        }

        Schema::create('mentorship_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->constrained('mentorship_milestones')->cascadeOnDelete();
            $table->foreignId('trainee_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('submission_url')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->enum('review_status', ['pending', 'approved', 'rejected', 'needs_changes'])->default('pending');
            $table->unsignedTinyInteger('score_technical')->nullable();
            $table->unsignedTinyInteger('score_communication')->nullable();
            $table->unsignedTinyInteger('score_autonomy')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->index(['milestone_id', 'review_status']);
            $table->index(['trainee_user_id', 'submitted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_submissions');
    }
};
