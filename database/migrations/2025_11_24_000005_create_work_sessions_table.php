<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->integer('duration_minutes')->default(60)->comment('Typiquement 60 (50min travail + 10min rapport)');
            $table->boolean('is_meeting')->default(false)->comment('true si visio cadrage ou clôture');
            $table->enum('delivery_speed', ['standard', 'express_24h', 'express_48h', 'express_72h'])->default('standard');
            $table->timestamp('deadline_at')->nullable()->comment('Utilisé si delivery_speed != standard');
            $table->text('report_text')->nullable();
            $table->json('report_files')->nullable();
            $table->integer('rebook_count')->default(0);
            $table->enum('status', ['scheduled', 'completed', 'late', 'cancelled'])->default('scheduled');
            $table->timestamps();

            $table->index('subscription_id');
            $table->index('start_at');
            $table->index('status');
            $table->index('deadline_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_sessions');
    }
};

