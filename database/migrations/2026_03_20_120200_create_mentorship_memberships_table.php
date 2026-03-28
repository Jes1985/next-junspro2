<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_memberships')) {
            return;
        }

        Schema::create('mentorship_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pod_id')->constrained('mentorship_pods')->cascadeOnDelete();
            $table->foreignId('trainee_user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('trainee_type', ['student', 'graduate'])->default('student');
            $table->enum('membership_status', ['applied', 'accepted', 'rejected', 'active', 'completed', 'dropped'])->default('applied');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('completion_reason', 255)->nullable();
            $table->timestamps();

            $table->unique(['pod_id', 'trainee_user_id'], 'mentorship_memberships_unique');
            $table->index(['trainee_user_id', 'membership_status']);
            $table->index(['pod_id', 'membership_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_memberships');
    }
};
