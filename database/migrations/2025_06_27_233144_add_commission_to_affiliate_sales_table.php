<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionToAffiliateSalesTable extends Migration
{
    public function up()
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            $table->decimal('commission', 10, 2)
                  ->after('amount')
                  ->default(0);
        });
    }

    public function down()
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            $table->dropColumn('commission');
        });
    }
}
