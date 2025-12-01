<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('memberships')) {
            Schema::table('memberships', function (Blueprint $table) {
                if (!Schema::hasColumn('memberships', 'conversation_id')) {
                    $table->string('conversation_id')->nullable()->after('modified');
                }
            });
        }

        if (Schema::hasTable('service_orders')) {
            Schema::table('service_orders', function (Blueprint $table) {
                if (!Schema::hasColumn('service_orders', 'conversation_id')) {
                    $table->string('conversation_id')->nullable()->after('raise_status');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('memberships') && Schema::hasColumn('memberships', 'conversation_id')) {
            Schema::table('memberships', function (Blueprint $table) {
                $table->dropColumn('conversation_id');
            });
        }

        if (Schema::hasTable('service_orders') && Schema::hasColumn('service_orders', 'conversation_id')) {
            Schema::table('service_orders', function (Blueprint $table) {
                $table->dropColumn('conversation_id');
            });
        }
    }
};

