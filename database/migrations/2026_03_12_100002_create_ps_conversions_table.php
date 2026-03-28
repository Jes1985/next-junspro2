<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ps_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ambassadeur_id')->constrained('ps_ambassadeurs')->onDelete('cascade');
            $table->foreignId('referred_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('product_type', ['pause_parcours', 'pause_freelance', 'pause_formateur', 'pause_retraite']);
            $table->string('stripe_payment_intent', 120)->nullable()->unique();
            $table->decimal('sale_amount', 10, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->enum('status', ['pending', 'validated', 'paid', 'cancelled'])->default('pending');
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ps_conversions');
    }
};
