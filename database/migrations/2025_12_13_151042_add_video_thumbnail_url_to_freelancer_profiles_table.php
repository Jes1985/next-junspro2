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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->string('video_thumbnail_url', 500)->nullable()->after('bio')->comment('URL de la miniature vidéo de présentation (format 16:9 recommandé)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn('video_thumbnail_url');
        });
    }
};
