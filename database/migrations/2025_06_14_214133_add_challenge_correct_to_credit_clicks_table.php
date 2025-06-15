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
        Schema::table('credit_clicks', function (Blueprint $table) {
            $table->boolean('challenge_correct')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credit_clicks', function (Blueprint $table) {
            $table->dropColumn('challenge_correct');
        });
    }
};
