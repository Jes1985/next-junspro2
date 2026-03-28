<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ps_ambassadeurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code', 60)->unique();
            $table->enum('status', ['pending', 'active', 'suspended'])->default('active');
            $table->enum('tier', ['standard', 'partenaire', 'ambassadeur'])->default('standard');
            $table->decimal('total_earned', 10, 2)->default(0);
            $table->decimal('pending_payout', 10, 2)->default(0);
            $table->decimal('paid_out', 10, 2)->default(0);
            $table->string('iban', 50)->nullable();
            $table->string('bic', 15)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_holder', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ps_ambassadeurs');
    }
};
