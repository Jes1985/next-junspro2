<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->integer('duration_minutes')->default(50);
            $table->boolean('is_meeting')->default(false);
            $table->string('delivery_speed')->default('standard');
            $table->dateTime('deadline_at')->nullable();
            $table->text('report_text')->nullable();
            $table->json('report_files')->nullable();
            $table->integer('rebook_count')->default(0);
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled
            $table->timestamps();
            
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->index('start_at');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_sessions');
    }
};
