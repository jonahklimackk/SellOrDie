<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSimpleUserIdIndexFromCredits extends Migration
{
    public function up()
    {
        Schema::table('credits', function (Blueprint $table) {
            // Adjust the index name below to match whatever SHOW INDEX reported
            $table->dropIndex('credits_user_id_created_at_index2');
        });
    }

    public function down()
    {
        Schema::table('credits', function (Blueprint $table) {
            // Re-create it if you ever roll back
            $table->index('user_id', 'credits_user_id_created_at_index2');
        });
    }
}
