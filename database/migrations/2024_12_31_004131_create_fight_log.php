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
        Schema::create('fight_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('clicked_ad_id');
            $table->integer('not_clicked_ad_id');
            $table->integer('clicked_ad_fight_id');
            $table->integer('not_clicked_ad_fight_id');
            $table->integer('clicked_ad_user_id');
            $table->integer('notClicked_ad_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fight_logs');
    }
};
