<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('affiliate_code', 20)->unique();
            $table->enum('tier', ['ambassador', 'elite', 'club'])->default('ambassador');
            // ambassador = 5%, elite = 7%, club = 10%
            $table->decimal('commission_rate', 5, 2)->default(5.00);
            $table->enum('status', ['pending', 'active', 'suspended'])->default('pending');
            $table->integer('active_conversions')->default(0); // pour calcul upgrade palier
            $table->decimal('total_earned', 10, 2)->default(0.00);
            $table->decimal('pending_payout', 10, 2)->default(0.00);
            $table->decimal('paid_out', 10, 2)->default(0.00);
            // Coordonnées bancaires pour virement (stockées chiffrées idéalement)
            $table->string('iban', 50)->nullable();
            $table->string('bic', 15)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_holder', 150)->nullable();
            // Lien personnalisé (slug custom optionnel)
            $table->string('custom_slug', 50)->nullable()->unique();
            $table->text('notes')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
