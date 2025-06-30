<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_sale_id')
                  ->constrained('affiliate_sales')
                  ->onDelete('cascade');
            $table->foreignId('affiliate_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->dateTime('paid_at')->nullable();
            $table->enum('status', ['pending','due','paid'])
                  ->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
