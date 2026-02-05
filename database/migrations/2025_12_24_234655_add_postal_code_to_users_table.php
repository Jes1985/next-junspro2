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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'postal_code')) {
                if (Schema::hasColumn('users', 'address')) {
                    $table->string('postal_code', 20)->nullable()->after('address');
                } else {
                    $table->string('postal_code', 20)->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'postal_code')) {
                $table->dropColumn('postal_code');
            }
        });
    }
};
