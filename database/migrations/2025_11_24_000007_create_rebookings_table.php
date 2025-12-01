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
        Schema::create('rebookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_session_id')->constrained('work_sessions')->onDelete('cascade');
            $table->timestamp('old_start_at');
            $table->timestamp('new_start_at');
            $table->foreignId('requested_by')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->text('reason')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->index('work_session_id');
            $table->index('requested_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rebookings');
    }
};

