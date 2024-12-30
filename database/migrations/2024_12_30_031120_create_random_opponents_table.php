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
        Schema::create('random_opponents', function (Blueprint $table) {
            $table->id();            
            $table->integer('ad_id');
            $table->integer('fighter_id');
            $table->integer('team_id');
            $table->integer('clicks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('random_opponents');
    }
};
