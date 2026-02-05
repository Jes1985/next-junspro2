<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ÉTAPE 4.1 — Chat pré-booking : structure lead_conversations + lien sur chat_messages.
     */
    public function up(): void
    {
        Schema::create('lead_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['client_id', 'freelancer_id']);
            $table->index('client_id');
            $table->index('freelancer_id');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreignId('lead_conversation_id')
                ->nullable()
                ->after('subscription_id')
                ->constrained('lead_conversations')
                ->nullOnDelete();
            $table->index('lead_conversation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropForeign(['lead_conversation_id']);
            $table->dropIndex(['lead_conversation_id']);
        });

        Schema::dropIfExists('lead_conversations');
    }
};
