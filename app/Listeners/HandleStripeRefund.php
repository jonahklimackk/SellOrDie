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
        $payload = $event->payload;

        if (! in_array($payload['type'], ['charge.refunded', 'refund.created'])) {
            return;
        }

        $data     = $payload['data']['object'];
        $chargeId = $data['charge'] ?? $data['id'];
        $amount   = ($data['amount_refunded'] ?? 0) / 100;

        if ($sale = AffiliateSale::where('stripe_charge_id', $chargeId)->first()) {
            $sale->update([
                'refunded'      => true,
                'refund_amount' => $amount,
                'refunded_at'   => now(),
            ]);
            Log::info("Marked AffiliateSale {$sale->id} refunded (\${$amount})");
        } else {
            Log::warning("No AffiliateSale found for charge {$chargeId}");
        }
    }
}
