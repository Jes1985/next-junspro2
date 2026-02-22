<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'native_language')) {
                $table->string('native_language', 10)->nullable()->after('onsite_city');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'spoken_languages')) {
                $table->text('spoken_languages')->nullable()->after('native_language');
            }
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            foreach (['native_language', 'spoken_languages'] as $col) {
                if (Schema::hasColumn('freelancer_profiles', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
