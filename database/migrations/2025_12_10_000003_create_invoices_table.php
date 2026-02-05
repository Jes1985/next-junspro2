<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions')->nullOnDelete();
            $table->string('payment_intent_id')->nullable();
            $table->string('currency', 10)->default('eur');
            $table->decimal('amount_base_total', 12, 2)->default(0);
            $table->decimal('amount_client_total', 12, 2)->default(0);
            $table->decimal('platform_commission_total', 12, 2)->default(0);
            $table->decimal('platform_client_fee_total', 12, 2)->default(0);
            $table->decimal('freelancer_net_total', 12, 2)->default(0);
            $table->decimal('commission_rate_used', 5, 4)->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index('payment_intent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};


