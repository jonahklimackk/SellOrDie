<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateCommissionsTable extends Migration
{
    public function up()
    {
        // Drop any old version
        Schema::dropIfExists('commissions');

        // Recreate as pure monthly summaries
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            // The affiliate who earns this commission
            $table->foreignId('affiliate_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Which month & year this row covers
            $table->tinyInteger('month')->unsigned();        // 1–12
            $table->smallInteger('year')->unsigned();        // e.g. 2025

            // Total commission for that period
            $table->decimal('amount', 10, 2);

            // Pending until paid
            $table->enum('status', ['pending', 'paid'])
                  ->default('pending');

            // When it actually got paid
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            // Prevent duplicate rows
            $table->unique(['affiliate_id','year','month']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
