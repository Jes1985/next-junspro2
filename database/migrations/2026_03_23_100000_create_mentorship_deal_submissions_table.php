<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mentorship_deal_submissions')) {
            return;
        }

        Schema::create('mentorship_deal_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // Profil déclaré
            $table->enum('profile_type', ['intern', 'junior'])->default('intern');

            // Contact / client
            $table->string('contact_name');           // Nom du contact trouvé
            $table->string('contact_email')->nullable();
            $table->string('contact_company')->nullable();
            $table->string('sector')->nullable();     // Secteur d'activité
            $table->string('how_found');              // Comment le contact a été trouvé

            // Mission
            $table->string('mission_title');
            $table->text('mission_description');
            $table->unsignedInteger('budget_estimate')->nullable(); // en €
            $table->string('timeline')->nullable();   // ex: "3 semaines", "1 mois"
            $table->text('technologies')->nullable(); // ex: "Laravel, Vue, Tailwind"
            $table->text('deliverables')->nullable(); // livrables attendus

            // Statut validation mentor
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->text('mentor_notes')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validated_at')->nullable();

            // Bonus résultant
            $table->string('bonus_applied')->nullable(); // ex: "+10% → 30% du net"

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_deal_submissions');
    }
};
