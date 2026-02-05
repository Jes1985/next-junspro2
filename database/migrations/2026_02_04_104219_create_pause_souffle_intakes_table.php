<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pause_souffle_intakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            
            // Réponses du questionnaire
            $table->integer('energy')->comment('Niveau d\'énergie (0-10)');
            $table->integer('clarity')->comment('Niveau de clarté (0-10)');
            $table->integer('tension')->comment('Niveau de tension/stress (0-10)');
            $table->enum('situation', ['dirigeant', 'salarie', 'parent', 'freelance', 'etudiant', 'transition']);
            $table->enum('rythme', ['1-session', '4-semaines', '3-mois']);
            $table->json('protect')->comment('Éléments à protéger');
            $table->enum('preference', ['douce', 'structuree', 'spirituel'])->nullable();
            
            // Plan et paiement
            $table->enum('plan_key', ['trial', 'cycle_4w', 'cycle_3m'])->comment('Clé du plan choisi');
            $table->string('stripe_price_id')->nullable()->comment('ID du price Stripe');
            $table->enum('status', ['pending_payment', 'paid', 'cancelled'])->default('pending_payment');
            $table->string('stripe_checkout_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            // Métadonnées
            $table->json('metadata')->nullable()->comment('Données supplémentaires');
            
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('status');
            $table->index('stripe_checkout_session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pause_souffle_intakes');
    }
};
