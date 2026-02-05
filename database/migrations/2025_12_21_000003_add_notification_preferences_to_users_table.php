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
            // Notifications email
            if (!Schema::hasColumn('users', 'email_sessions')) {
                if (Schema::hasColumn('users', 'default_view')) {
                    $table->boolean('email_sessions')->default(true)->after('default_view');
                } else {
                    $table->boolean('email_sessions')->default(true)->after('updated_at');
                }
            }
            
            if (!Schema::hasColumn('users', 'email_reports')) {
                $table->boolean('email_reports')->default(true)->after('email_sessions');
            }
            
            if (!Schema::hasColumn('users', 'email_messages')) {
                $table->boolean('email_messages')->default(true)->after('email_reports');
            }
            
            if (!Schema::hasColumn('users', 'email_billing')) {
                $table->boolean('email_billing')->default(true)->after('email_messages');
            }
            
            if (!Schema::hasColumn('users', 'email_news')) {
                $table->boolean('email_news')->default(false)->after('email_billing');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_sessions',
                'email_reports',
                'email_messages',
                'email_billing',
                'email_news',
            ]);
        });
    }
};

