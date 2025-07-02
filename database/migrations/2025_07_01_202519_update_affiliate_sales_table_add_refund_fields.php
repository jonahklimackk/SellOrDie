<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAffiliateSalesTableAddRefundFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            // link back to Stripe
            $table->string('stripe_charge_id')
                  ->nullable()
                  ->index()
                  ->after('amount');

            $table->string('stripe_payment_intent')
                  ->nullable()
                  ->index()
                  ->after('stripe_charge_id');

            // refund tracking
            $table->boolean('refunded')
                  ->default(false)
                  ->after('stripe_payment_intent');

            $table->decimal('refund_amount', 10, 2)
                  ->default(0)
                  ->after('refunded');

            $table->timestamp('refunded_at')
                  ->nullable()
                  ->after('refund_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_sales', function (Blueprint $table) {
            $table->dropIndex(['stripe_charge_id']);
            $table->dropIndex(['stripe_payment_intent']);

            $table->dropColumn([
                'stripe_charge_id',
                'stripe_payment_intent',
                'refunded',
                'refund_amount',
                'refunded_at',
            ]);
        });
    }
}
