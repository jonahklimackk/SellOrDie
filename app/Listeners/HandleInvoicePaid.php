<?php

namespace App\Listeners;

use Laravel\Cashier\Events\InvoicePaymentSucceeded;
use App\Models\AffiliateSale;
use App\Services\AffiliateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class HandleInvoicePaid implements ShouldQueue
{
    public function handle(InvoicePaymentSucceeded $event): void
    {
        $invoice = $event->invoice;           // Stripe\Invoice
        $user    = $event->user;              // Your Billable model

        Log::info("HandleInvoicePaid for user {$user->id}, invoice {$invoice->id}");

        // 1) Skip if no referrer
        $referrerId = $user->referrer_id;
        if (! $referrerId) {
            Log::info("No referrer on user {$user->id}, skipping affiliate sale.");
            return;
        }

        // 2) Gather data
        $amount          = ($invoice->amount_paid ?? 0) / 100;
        $paymentIntentId = $invoice->payment_intent;
        // Grab the first charge from the expanded PaymentIntent
        $pi              = $event->invoice->payment_intent; 
        $chargeId        = data_get($pi->charges->data, '0.id');

        // 3) Create the sale with real Stripe IDs
        $sale = AffiliateSale::create([
            'referrer_id'           => $referrerId,
            'buyer_id'              => $user->id,
            'campaign'              => $user->affiliate_campaign,
            'product'               => $invoice->lines->data[0]->price->nickname ?? $invoice->subscription, 
            'amount'                => $amount,
            'stripe_payment_intent' => $paymentIntentId,
            'stripe_charge_id'      => $chargeId,
        ]);

        Log::info("AffiliateSale created ID {$sale->id} with charge {$chargeId}");

        // 4) Award the commission
        AffiliateService::handleCommissionForSale($sale);

        Log::info("HandleInvoicePaid complete for sale {$sale->id}");
    }
}
