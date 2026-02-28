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
        // Check if columns don't already exist
        if (!Schema::hasColumn('work_sessions', 'report_text')) {
            Schema::table('work_sessions', function (Blueprint $table) {
                $table->text('report_text')->nullable()->after('deadline_at');
            });
        }
        
        if (!Schema::hasColumn('work_sessions', 'report_files')) {
            Schema::table('work_sessions', function (Blueprint $table) {
                $table->json('report_files')->nullable()->after('report_text');
            });
        }
        
        if (!Schema::hasColumn('work_sessions', 'rebook_count')) {
            Schema::table('work_sessions', function (Blueprint $table) {
                $table->integer('rebook_count')->default(0)->after('report_files');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_sessions', function (Blueprint $table) {
            $table->dropColumn(['report_text', 'report_files', 'rebook_count']);
        });
    }
};
