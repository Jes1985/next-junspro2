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
        Schema::create('premium_services', function (Blueprint $table) {
            $table->id();
            $table->enum('owner_type', ['client', 'freelance']);
            $table->unsignedBigInteger('owner_id');
            $table->enum('type', [
                'matchdirect',
                'concierge',
                'audit',
                'pack_confiance_plus',
                'boost',
                'premium_position',
                'verification',
                'coaching',
                'plan_pro'
            ]);
            $table->decimal('price', 10, 2);
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['owner_type', 'owner_id']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('premium_services');
    }
};

