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
        Schema::create('credit_clicks', function (Blueprint $table) {
            $table->id();
            $table->integer('recipient_id')->default(0);
            $table->integer('sender_id')->default(0);
            $table->string('key')->nullable();
            $table->integer('credits')->default(0); 
            // $table->integer('clicks')->default(0);   
            $table->boolean('earned_credits')->default(0);
            $table->string('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_clicks');
    }
};
