<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Si les anciennes colonnes existent, migrer les données vers les nouvelles et supprimer les anciennes
        if (Schema::hasColumn('users', 'notify_sessions_planned')) {
            // Migrer les données si les nouvelles colonnes n'existent pas encore
            if (!Schema::hasColumn('users', 'email_sessions')) {
                DB::statement('ALTER TABLE users ADD COLUMN email_sessions BOOLEAN DEFAULT TRUE');
                DB::statement('UPDATE users SET email_sessions = notify_sessions_planned WHERE notify_sessions_planned IS NOT NULL');
            }
            
            if (!Schema::hasColumn('users', 'email_reports')) {
                DB::statement('ALTER TABLE users ADD COLUMN email_reports BOOLEAN DEFAULT TRUE');
                DB::statement('UPDATE users SET email_reports = notify_reports_sent WHERE notify_reports_sent IS NOT NULL');
            }
            
            if (!Schema::hasColumn('users', 'email_messages')) {
                DB::statement('ALTER TABLE users ADD COLUMN email_messages BOOLEAN DEFAULT TRUE');
                DB::statement('UPDATE users SET email_messages = notify_messages_received WHERE notify_messages_received IS NOT NULL');
            }
            
            if (!Schema::hasColumn('users', 'email_billing')) {
                DB::statement('ALTER TABLE users ADD COLUMN email_billing BOOLEAN DEFAULT TRUE');
                DB::statement('UPDATE users SET email_billing = notify_billing_info WHERE notify_billing_info IS NOT NULL');
            }
            
            if (!Schema::hasColumn('users', 'email_news')) {
                DB::statement('ALTER TABLE users ADD COLUMN email_news BOOLEAN DEFAULT FALSE');
            }
            
            // Supprimer les anciennes colonnes
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'notify_sessions_planned',
                    'notify_reports_sent',
                    'notify_messages_received',
                    'notify_session_reminders',
                    'notify_billing_info',
                ]);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recréer les anciennes colonnes si nécessaire (pour rollback)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'notify_sessions_planned')) {
                $table->boolean('notify_sessions_planned')->default(true);
                DB::statement('UPDATE users SET notify_sessions_planned = email_sessions WHERE email_sessions IS NOT NULL');
            }
        });
    }
};

