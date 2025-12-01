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
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('hourly_rate', 8, 2)->comment('Tarif horaire entre 3€ et 200€');
            $table->integer('reliability_score')->default(100)->comment('Score de fiabilité 0-100');
            $table->enum('wellness_plan', ['none', 'essentiel', 'premium'])->default('none');
            $table->text('bio')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->string('timezone')->default('Europe/Paris');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->index('user_id');
            $table->index('reliability_score');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};

