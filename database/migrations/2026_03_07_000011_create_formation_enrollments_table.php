<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('pending');    // pending|active|completed|suspended
            $table->string('stripe_payment_intent')->nullable();
            $table->decimal('amount_paid', 8, 2)->default(0);
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('attestation_code')->nullable()->unique(); // code unique de l'attestation
            $table->timestamp('attestation_issued_at')->nullable();
            $table->timestamps();

            $table->unique('user_id'); // un seul enrollment par utilisateur
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_enrollments');
    }
};
