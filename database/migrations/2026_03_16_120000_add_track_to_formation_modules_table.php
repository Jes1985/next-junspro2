<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->string('track')->default('parcours')->after('week_label');
            $table->index(['track', 'order']);
        });

        DB::table('formation_modules')
            ->whereIn('slug', [
                '07-je-transmets-le-rituel',
                '08-je-maitrise-la-vision',
            ])
            ->update(['track' => 'praticien']);
    }

    public function down(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->dropIndex(['track', 'order']);
            $table->dropColumn('track');
        });
    }
};