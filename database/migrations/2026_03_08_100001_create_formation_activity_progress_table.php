<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_activity_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedSmallInteger('activity_index'); // 0-based index dans le JSON activities
            $table->text('notes')->nullable();              // Journal pour exercices d'écriture
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['enrollment_id', 'module_id', 'activity_index'], 'fap_unique');
            $table->foreign('enrollment_id')->references('id')->on('formation_enrollments')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('formation_modules')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_activity_progress');
    }
};
