<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_freelancer_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->decimal('total_base_amount', 12, 2)->default(0);
            $table->decimal('total_client_amount', 12, 2)->default(0);
            $table->decimal('current_commission_rate', 5, 4)->default(0.20); // 0.2000, 0.1600, 0.1200
            $table->timestamps();

            $table->unique(['client_id', 'freelancer_id'], 'client_freelancer_unique');
            $table->index(['client_id', 'freelancer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_freelancer_stats');
    }
};


