<x-app-layout>
  <x-slot name="header">
    <h2 class="font-montserrat text-2xl text-sod-yellow">
      Matrix Genealogy & Credit Earnings
    </h2>
  </x-slot>

  <div class="min-h-screen bg-sod-bg text-gray-100 px-4 py-8">
    {{-- 1) Affiliate sales --}}
    <section class="mb-12">
      <h3 class="text-xl font-bold text-white mb-4">Your Affiliate Purchases</h3>

      @if($affiliateSales->isEmpty())
        <p class="text-gray-400">No affiliate sales yet.</p>
      @else
        <ul class="space-y-2">
          @foreach($affiliateSales as $sale)
            <li class="bg-sod-panel p-4 rounded-xl shadow">
              {{ $sale->buyer->name }} bought <strong>${{ number_format($sale->amount,2) }}</strong>
            </li>
          @endforeach
        </ul>
      @endif
    </section>

    {{-- 2) Matrix tree --}}
    <section>
      <h3 class="text-xl font-bold text-white mb-4">Matrix Genealogy</h3>

      @if(empty($tree))
        <p class="text-gray-400">No matrix positions yet.</p>
      @else
        <ul class="space-y-4">
          @foreach($tree as $node)
            @include('partials.matrix-node', ['node' => $node, 'level' => 0])
          @endforeach
        </ul>
      @endif
    </section>
  </div>
</x-app-layout>
