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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->string('identity_document')->nullable()->after('timezone');
            $table->string('bank_iban')->nullable()->after('identity_document');
            $table->string('bank_account_holder')->nullable()->after('bank_iban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn(['identity_document', 'bank_iban', 'bank_account_holder']);
        });
    }
};
