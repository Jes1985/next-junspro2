<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_milestones')) {
            return;
        }

        Schema::create('mentorship_milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained('mentorship_missions')->cascadeOnDelete();
            $table->string('title');
            $table->text('objectives_text')->nullable();
            $table->unsignedSmallInteger('order_index')->default(1);
            $table->unsignedTinyInteger('weight_percent')->default(0);
            $table->date('due_date')->nullable();
            $table->enum('status', ['locked', 'open', 'submitted', 'validated', 'revision_requested'])->default('locked');
            $table->timestamps();

            $table->index(['mission_id', 'order_index']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_milestones');
    }
};
