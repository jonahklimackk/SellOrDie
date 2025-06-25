<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            // the user who got referred
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            // the referrer
            $table->foreignId('referrer_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            // optional campaign tag
            $table->string('campaign')->nullable();
            $table->timestamps();

            // you can add an index if you like:
            $table->index(['referrer_id', 'campaign']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
