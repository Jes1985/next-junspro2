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
        Schema::create('calendar_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->integer('weekday')->comment('0=lundi, 6=dimanche');
            $table->integer('hour')->comment('0 à 23, heure pleine');
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->index('freelancer_id');
            $table->index(['weekday', 'hour']);
            $table->unique(['freelancer_id', 'weekday', 'hour']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_slots');
    }
};

