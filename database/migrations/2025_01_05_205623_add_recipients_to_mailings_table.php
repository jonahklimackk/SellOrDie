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
        Schema::table('mailings', function (Blueprint $table) {
            $table->integer('recipients')->after('spent_credits')->default(0);
            $table->integer('views')->after('recipients')->default(0);
            $table->integer('clicks')->after('views')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mailings', function (Blueprint $table) {
            $table->dropColumn('recipients');
             $table->dropColumn('views');   
              $table->dropColumn('clicks');

        });
    }
};
