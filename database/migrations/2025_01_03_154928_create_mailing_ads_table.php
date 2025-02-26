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
        Schema::create('mailing_ads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('team_id');
             $table->integer('mailing_id')->nullable();
            $table->string('subject');
            $table->text('body');
            $table->string('url');
            $table->string('status');
            $table->string('category')->nullable();
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailing_ads');
    }
};
