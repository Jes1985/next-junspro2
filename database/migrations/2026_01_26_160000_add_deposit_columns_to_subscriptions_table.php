<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * V2 Étape 1.2 — Acompte obligatoire en présentiel via Stripe.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('format');
            $table->timestamp('deposit_paid_at')->nullable()->after('deposit_amount');
            $table->string('deposit_payment_intent_id')->nullable()->after('deposit_paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['deposit_amount', 'deposit_paid_at', 'deposit_payment_intent_id']);
        });
    }
};
