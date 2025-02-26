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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('affiliate_id')->unsigned();
            // $table->foreign('affiliate_id')->references('id')->on('users');
            $table->string('name')->default('aff');
            $table->string('value')->default('/');
            $table->integer('sales')->default(0);
            $table->integer('unique')->default(0);
            $table->integer('raw')->default(0);
            $table->integer('confirms')->default(0);
            $table->integer('joins')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
