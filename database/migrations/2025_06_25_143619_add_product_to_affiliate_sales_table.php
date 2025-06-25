<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductToAffiliateSalesTable extends Migration
{
    public function up()
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            $table->string('product')->after('campaign');
        });
    }
    public function down()
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            $table->dropColumn('product');
        });
    }
}

