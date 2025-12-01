<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // e.g. 'Phonepe'
            $table->string('keyword')->unique();    // e.g. 'phonepe'
            $table->longText('information')->nullable(); // json-encoded settings
            $table->tinyInteger('status')->default(0);   // 0 = disabled, 1 = enabled
            $table->timestamps();

            $table->index('keyword');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_gateways');
    }
};

