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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->integer('hours_per_week')->comment('Valeurs: 1, 2, 4, 8, 12, 16, 20, 24');
            $table->float('hours_total_month')->comment('hours_per_week * 4');
            $table->float('hours_remaining')->default(0)->comment('Heures restantes sur le cycle en cours');
            $table->decimal('price_base', 10, 2)->comment('Prix mensuel hors Express');
            $table->enum('delivery_mode', ['standard', 'express_24h', 'express_48h', 'express_72h'])->default('standard');
            $table->enum('status', ['pending', 'active', 'paused', 'cancelled'])->default('pending');
            $table->string('stripe_subscription_id')->nullable();
            $table->timestamp('next_billing_at')->nullable();
            $table->timestamps();

            $table->index('client_id');
            $table->index('freelancer_id');
            $table->index('status');
            $table->index('stripe_subscription_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};

