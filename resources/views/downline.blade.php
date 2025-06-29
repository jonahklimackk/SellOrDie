{{-- resources/views/downline.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-montserrat text-2xl text-sod-yellow leading-tight">
            Your Downline
        </h2>
    </x-slot>

    <div class="min-h-screen bg-sod-bg text-gray-100">
        <div class="container mx-auto py-8 px-4">
            {{-- Log-in credentials --}}
            <div class="mb-8 text-gray-400">
                <strong>Log in as:</strong>
                <code class="bg-gray-800 px-2 py-1 rounded">affiliate@example.com</code>
                /
                <code class="bg-gray-800 px-2 py-1 rounded">password</code>
            </div>

            @if($referralData->isEmpty())
                <p class="text-gray-400">You have no referrals yet.</p>
            @else
                <ul class="space-y-6">
                    @foreach($referralData as $data)
                        <li class="bg-sod-panel border border-sod-yellow rounded-2xl p-6 shadow-lg">
                            <h3 class="text-2xl font-bold text-white mb-2">
                                {{ $data['user']->name }}
                                <span class="text-gray-500 text-sm">({{ $data['user']->email }})</span>
                            </h3>

                            <h4 class="font-semibold text-sod-yellow mt-4">Sales &amp; Commissions</h4>
                            @if($data['sales']->isEmpty())
                                <p class="text-gray-500">No sales yet.</p>
                            @else
                                <ul class="list-disc list-inside text-gray-300 mt-2">
                                    @foreach($data['sales'] as $sale)
                                        <li class="mb-1">
                                            <span class="text-white">${{ number_format($sale->amount,2) }}</span>
                                            → Commission:
                                            <span class="text-sod-yellow">
                                                ${{ number_format($sale->amount * config("affiliate.tiers.".Auth::user()->membership_tier.".commission"),2) }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <p class="mt-4 text-gray-200">
                                <strong>Total from this user:</strong>
                                <span class="text-sod-yellow">
                                    ${{ number_format($data['totalCommission'],2) }}
                                </span>
                            </p>

                            @if($data['user']->referrals->isNotEmpty())
                                <div class="mt-6 ml-4 border-l-4 border-sod-yellow pl-4">
                                    <h5 class="font-semibold text-white">Their Referrals</h5>
                                    <ul class="list-disc list-inside text-gray-300 mt-2">
                                        @foreach($data['user']->referrals as $sub)
                                            <li>
                                                {{ $sub->name }}
                                                <span class="text-gray-500 text-sm">({{ $sub->email }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
