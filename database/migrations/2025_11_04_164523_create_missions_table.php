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
        if (Schema::hasTable('missions')) {
            return;
        }
        Schema::create('missions', function (Blueprint $table) {
            $table->id('id_mission');
            $table->string('client_nom');
            $table->string('client_email');
            $table->string('client_telephone')->nullable();
            $table->text('description_mission');
            $table->enum('offre', ['Accompagnement', 'Mise_en_relation', 'Aucune'])->default('Aucune');
            $table->decimal('budget', 10, 2);
            $table->enum('bonus', ['Aucun', 'Vitalite', 'Serenite', 'Equilibre'])->default('Aucun');
            $table->enum('statut', ['En_attente', 'Paiement_valide', 'RDV_planifie', 'Termine'])->default('En_attente');
            $table->string('calendly_link')->nullable();
            $table->string('zoom_link')->nullable();
            $table->json('freelance_propose')->nullable();
            $table->string('fichier_joint')->nullable();
            $table->string('stripe_payment_id')->nullable();
            $table->string('calendly_event_id')->nullable();
            $table->string('zoom_meeting_id')->nullable();
            $table->timestamp('date_soumission')->useCurrent();
            $table->timestamp('date_rdv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};


