<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availability_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_at'); // stored in UTC
            $table->dateTime('end_at');   // stored in UTC
            $table->string('status', 20)->default('available');
            $table->string('timezone', 60)->default('Europe/Paris');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availability_slots');
    }
};
