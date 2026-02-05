<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->decimal('base_hourly_rate_snapshot', 10, 2)->nullable()->after('price_base');
            $table->decimal('client_hourly_rate_snapshot', 10, 2)->nullable()->after('base_hourly_rate_snapshot');
            $table->decimal('commission_rate_snapshot', 5, 4)->nullable()->after('client_hourly_rate_snapshot');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'base_hourly_rate_snapshot',
                'client_hourly_rate_snapshot',
                'commission_rate_snapshot',
            ]);
        });
    }
};


