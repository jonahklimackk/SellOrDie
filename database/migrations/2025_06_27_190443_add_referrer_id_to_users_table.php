<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferrerIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // nullable, points back to users.id
            $table->unsignedBigInteger('referrer_id')
                  ->nullable()
                  ->after('id');

            $table->foreign('referrer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
            $table->dropColumn('referrer_id');
        });
    }
}
