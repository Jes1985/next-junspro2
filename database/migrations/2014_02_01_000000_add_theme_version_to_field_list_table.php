<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('field_list') && !Schema::hasColumn('field_list', 'theme_version')) {
            Schema::table('field_list', function (Blueprint $table) {
                $table->string('theme_version')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('field_list') && Schema::hasColumn('field_list', 'theme_version')) {
            Schema::table('field_list', function (Blueprint $table) {
                $table->dropColumn('theme_version');
            });
        }
    }
};
