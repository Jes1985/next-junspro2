<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorship_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Plan souscrit : cycle_1 (49€), cycle_2 (89€), cycle_4 (159€)
            $table->enum('plan_key', ['cycle_1', 'cycle_2', 'cycle_4']);

            // Stripe
            $table->string('stripe_subscription_id')->nullable()->index();
            $table->string('stripe_checkout_session_id')->nullable()->index();

            // Statut
            $table->enum('status', ['pending', 'active', 'cancelled', 'past_due'])->default('pending')->index();

            // Cycle courant (4 semaines)
            $table->date('current_cycle_start')->nullable();
            $table->date('current_cycle_end')->nullable();
            $table->timestamp('next_billing_at')->nullable();

            // Montant & dates
            $table->decimal('price_paid', 8, 2)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_subscriptions');
    }
};
