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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->enum('threshold_reached', ['501', '1001', '5001'])->comment('Seuils: 501€, 1001€, 5001€');
            $table->integer('sessions_count')->comment('1, 2 ou 4 séances offertes');
            $table->enum('status', ['pending', 'claimed', 'completed'])->default('pending');
            $table->string('calendly_link')->nullable();
            $table->timestamps();

            $table->index('client_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
};

