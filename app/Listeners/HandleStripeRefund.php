<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;
use App\Models\AffiliateSale;
use Illuminate\Support\Facades\Log;

class HandleStripeRefund implements ShouldQueue
{
    /**
     * Handle an incoming Stripe refund webhook.
     */
    public function handle(WebhookReceived $event): void
    {
        // $payload = $event->payload;

        // if (! in_array($payload['type'] ?? '', ['charge.refunded', 'refund.created'], true)) {
        //     return;
        // }

        // $data     = $payload['data']['object'];
        // $chargeId = $data['charge'] ?? $data['id'];
        // $amount   = ($data['amount_refunded'] ?? 0) / 100;

        // $sale = AffiliateSale::where('stripe_charge_id', $chargeId)->first();
        // if (! $sale) {
        //     Log::warning("No AffiliateSale found for charge {$chargeId}");
        //     return;
        // }

        // // Update refund status and reset commission
        // $sale->update([
        //     'refunded'      => true,
        //     'refund_amount' => $amount,
        //     'refunded_at'   => now(),
        //     'commission'    => 0.00,
        // ]);

        // Log::info("Marked AffiliateSale {$sale->id} refunded (\${$amount}) and commission reset to 0");
        return;
    }
}