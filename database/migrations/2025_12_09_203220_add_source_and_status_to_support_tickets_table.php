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
        if (!Schema::hasTable('support_tickets')) {
            return;
        }
        Schema::table('support_tickets', function (Blueprint $table) {
            // Ajouter le champ source si il n'existe pas
            if (!Schema::hasColumn('support_tickets', 'source')) {
                $table->string('source', 50)->nullable()->after('attachment');
            }
            
            // Ajouter le champ status si il n'existe pas
            if (!Schema::hasColumn('support_tickets', 'status')) {
                $table->enum('status', ['open', 'in_progress', 'closed'])->default('open')->after('source');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('support_tickets')) {
            return;
        }
        Schema::table('support_tickets', function (Blueprint $table) {
            if (Schema::hasColumn('support_tickets', 'source')) {
                $table->dropColumn('source');
            }
            if (Schema::hasColumn('support_tickets', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
