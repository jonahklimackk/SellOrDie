<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use App\Models\AffiliateSale;
use App\Models\User;
use App\Services\AffiliateService;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class StripeWebhookController extends Controller
{
    /**
     * Handle incoming Stripe webhooks for Spark/Cashier and affiliate tracking.
     */
    public function handle(Request $request)
    {
        // 1) Proxy the request to Cashier (verifies signature & updates subscriptions)
        app(CashierWebhookController::class)->handleWebhook($request);

        // 2) Decode the raw JSON payload
        $payload = $request->getContent();
        $event   = json_decode($payload, true);
        if (! is_array($event) || ! isset($event['type'], $event['data']['object'])) {
            Log::warning('StripeWebhookController: invalid payload JSON');
            return response('Invalid payload', 400);
        }

        $type   = $event['type'];
        $object = $event['data']['object'];

        // 3) Handle charge.succeeded → create sale + commission
        if ($type === 'charge.succeeded') {
            $chargeId = $object['id'];
            $customer = $object['customer'] ?? null;
            $amount   = (($object['amount'] ?? 0) / 100);

            Log::info("🔔 charge.succeeded for charge {$chargeId}");

            if (! $customer) {
                Log::warning("charge.succeeded missing customer for {$chargeId}");
                return response('OK', 200);
            }

            $user = User::where('stripe_id', $customer)->first();
            if (! $user || empty($user->referrer_id)) {
                Log::info("No referrer for customer={$customer}, skipping affiliate sale");
                return response('OK', 200);
            }

            $sale = AffiliateSale::create([
                'referrer_id'           => $user->referrer_id,
                'buyer_id'              => $user->id,
                'campaign'              => $user->affiliate_campaign,
                'product'               => data_get($object, 'invoice', 'subscription'),
                'amount'                => $amount,
                'stripe_payment_intent' => $object['payment_intent'] ?? null,
                'stripe_charge_id'      => $chargeId,
            ]);

            Log::info("AffiliateSale created ID {$sale->id} with charge {$chargeId}");
            AffiliateService::handleCommissionForSale($sale);

            return response('OK', 200);
        }

        // 4) Handle refunds → mark refunded, set refund amount, zero commission
        if (in_array($type, ['charge.refunded', 'refund.created'], true)) {
            $chgId  = $object['charge'] ?? $object['id'];
            $refAmt = (($object['amount_refunded'] ?? 0) / 100);

            Log::info("🔔 {$type} for charge {$chgId}");

            $sale = AffiliateSale::where('stripe_charge_id', $chgId)->first();
            if ($sale) {
                // Use attribute assignment to bypass fillable restrictions
                $sale->refunded       = true;
                $sale->refund_amount  = $refAmt;
                $sale->refunded_at    = now();
                $sale->save();

                Log::info("Marked AffiliateSale {$sale->id} refunded (\${$refAmt})");
            } else {
                Log::warning("No AffiliateSale found for charge {$chgId}");
            }

            return response('OK', 200);
        }

        // 5) Ignore other events for affiliate logic
        Log::debug("StripeWebhookController: ignored event {$type}");
        return response('OK', 200);
    }
}
