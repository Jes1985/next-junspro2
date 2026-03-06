<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nexus_onboarding')) {
                $table->longText('nexus_onboarding')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'nexus_offer')) {
                $table->longText('nexus_offer')->nullable()->after('nexus_onboarding');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('users', 'nexus_onboarding') ? 'nexus_onboarding' : null,
                Schema::hasColumn('users', 'nexus_offer')      ? 'nexus_offer'      : null,
            ]));
        });
    }
};
