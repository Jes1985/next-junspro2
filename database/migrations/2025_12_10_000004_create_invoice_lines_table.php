<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->decimal('hours', 8, 2)->default(1);
            $table->decimal('base_amount', 12, 2)->default(0);
            $table->decimal('client_amount', 12, 2)->default(0);
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->decimal('client_fee_amount', 12, 2)->default(0);
            $table->decimal('freelancer_net_amount', 12, 2)->default(0);
            $table->decimal('platform_total_amount', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_lines');
    }
};


