<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Dates de vie de l'abonnement
            $table->timestamp('starts_at')->nullable()->after('next_billing_at');
            $table->timestamp('ends_at')->nullable()->after('starts_at');

            // Options Express souscrites
            $table->boolean('has_express_24h')->default(false)->after('delivery_mode');
            $table->boolean('has_express_48h')->default(false)->after('has_express_24h');
            $table->boolean('has_express_72h')->default(false)->after('has_express_48h');

            // Rectifications & kick-off
            $table->unsignedTinyInteger('max_rectifications_per_delivery')
                ->default(2)
                ->after('hours_remaining');

            $table->boolean('kickoff_done')
                ->default(false)
                ->after('ends_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'starts_at',
                'ends_at',
                'has_express_24h',
                'has_express_48h',
                'has_express_72h',
                'max_rectifications_per_delivery',
                'kickoff_done',
            ]);
        });
    }
};



