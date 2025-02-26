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
        Schema::create('membership', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('description')->default('');
            $table->double('price')->default(0);
            $table->integer('period')->default(0);
            $table->integer('mailing_freq')->default(0);
            $table->integer('mailing_bonus')->default(0);
            $table->integer('credits_bonus')->default(0);
            $table->integer('mailing_max')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership');
    }
};
