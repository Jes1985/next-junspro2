<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_conversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliate_id');
            $table->unsignedBigInteger('referred_user_id'); // l'utilisateur converti
            // Contexte de la transaction source
            $table->string('source_type', 50)->nullable(); // 'mission', 'homeswap', 'subscription', etc.
            $table->unsignedBigInteger('source_id')->nullable(); // id de la mission/abonnement
            $table->string('stripe_payment_intent', 100)->nullable(); // référence Stripe
            $table->decimal('transaction_amount', 10, 2)->default(0.00); // montant HT de la transaction
            $table->decimal('commission_rate', 5, 2)->default(5.00); // taux appliqué au moment du calcul
            $table->decimal('commission_amount', 10, 2)->default(0.00); // montant de la commission
            $table->enum('status', ['pending', 'validated', 'paid', 'cancelled'])->default('pending');
            // pending   = transaction en cours de validation (J+7 anti-fraude)
            // validated = commission confirmée, en attente de virement
            // paid      = virement effectué
            // cancelled = remboursement ou annulation
            $table->integer('commission_month')->nullable(); // mois de récurrence (1, 2, ..., 24)
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
            $table->foreign('referred_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['affiliate_id', 'status']);
            $table->index(['stripe_payment_intent']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_conversions');
    }
};
