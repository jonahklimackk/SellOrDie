<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCreatedCompositeIndexToCredits extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('credits', function (Blueprint $table) {
            // adds an index on (user_id, created_at) for faster date-range lookups
            $table->index(
                ['user_id', 'created_at'],
                'credits_user_id_created_at_index2'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('credits', function (Blueprint $table) {
            // drops that composite index
            $table->dropIndex('credits_user_id_created_at_index');
        });
    }
}
