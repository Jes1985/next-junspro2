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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referrer_id'); // Parrain (User)
            $table->unsignedBigInteger('referred_id'); // Filleul (User)
            $table->unsignedBigInteger('client_profile_id')->nullable(); // Profil client du filleul
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->decimal('reward_amount', 10, 2)->default(10.00); // Montant de la récompense
            $table->decimal('benefit_amount', 10, 2)->nullable(); // Montant de l'avantage filleul
            $table->timestamp('first_booking_at')->nullable(); // Date de la première réservation
            $table->timestamp('first_service_confirmed_at')->nullable(); // Date de confirmation première prestation
            $table->timestamp('reward_credited_at')->nullable(); // Date d'attribution de la récompense
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('referrer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('referred_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_profile_id')->references('id')->on('client_profiles')->onDelete('set null');
            
            // Un filleul ne peut avoir qu'un seul parrain
            $table->unique('referred_id');
            
            // Index pour les requêtes fréquentes
            $table->index('referrer_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
};

