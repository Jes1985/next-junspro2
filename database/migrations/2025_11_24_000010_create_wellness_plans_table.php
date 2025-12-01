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
        Schema::create('wellness_plans', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['essentiel', 'premium']);
            $table->decimal('price_monthly', 8, 2);
            $table->integer('sessions_per_month');
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
        Schema::dropIfExists('wellness_plans');
    }
};

