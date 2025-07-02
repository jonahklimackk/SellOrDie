<x-app-layout>
  <div class="py-8 bg-[#1f1c27] min-h-screen text-white">
    <x-affiliate.submenu />

    <div class="max-w-4xl mx-auto bg-gray-900 p-6 rounded-2xl shadow-2xl">
      {{-- Main Sales --}}
      <h3 class="text-2xl font-bold text-yellow-300 mb-6">Your Sales</h3>

      {{-- Month selector --}}
      <form method="GET" action="{{ url('/affiliate/sales') }}" class="mb-6">
        <select name="month" onchange="this.form.submit()" class="bg-gray-800 text-white px-3 py-2 rounded-lg">
          @foreach($months as $value => $label)
            <option value="{{ $value }}" {{ $value === $currentMonth ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </form>

      {{-- Non-refunded sales table --}}
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-800 text-yellow-300">
          <tr>
            <th class="px-4 py-2 text-left">Referral</th>
            <th class="px-4 py-2 text-left">Product</th>
            <th class="px-4 py-2 text-right">Amount</th>
            <th class="px-4 py-2 text-right">Commission</th>
            <th class="px-4 py-2 text-right">Date</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
          @forelse($sales as $sale)
            <tr>
              <td class="px-4 py-2">{{ $sale->buyer->name }}</td>
              <td class="px-4 py-2">{{ $sale->product }}</td>
              <td class="px-4 py-2 text-right">${{ number_format($sale->amount, 2) }}</td>
              <td class="px-4 py-2 text-right">${{ number_format($sale->commission, 2) }}</td>
              <td class="px-4 py-2 text-right">{{ $sale->created_at->format('M j, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                No referral sales for this month.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Main total --}}
      <div class="text-right mt-6 font-semibold text-yellow-300">
        Total Commission:&nbsp;${{ number_format($totalCommission, 2) }}
      </div>

      {{-- Refunded Sales --}}
      @if($refundedSales->isNotEmpty())
        <h3 class="text-2xl font-bold text-red-400 mt-12 mb-6">Refunded Sales</h3>
        <table class="min-w-full divide-y divide-gray-700">
          <thead class="bg-gray-800 text-yellow-300">
            <tr>
              <th class="px-4 py-2 text-left">Referral</th>
              <th class="px-4 py-2 text-left">Product</th>
              <th class="px-4 py-2 text-right">Amount</th>
              <th class="px-4 py-2 text-right">Commission</th>
              <th class="px-4 py-2 text-right">Refunded</th>
              <th class="px-4 py-2 text-right">Date</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700">
            @foreach($refundedSales as $sale)
              <tr>
                <td class="px-4 py-2">{{ $sale->buyer->name }}</td>
                <td class="px-4 py-2">{{ $sale->product }}</td>
                <td class="px-4 py-2 text-right">${{ number_format($sale->amount, 2) }}</td>
                <td class="px-4 py-2 text-right">${{ number_format($sale->commission, 2) }}</td>
                <td class="px-4 py-2 text-right">${{ number_format($sale->refund_amount, 2) }}</td>
                <td class="px-4 py-2 text-right">{{ $sale->created_at->format('M j, Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{-- Refunded total --}}
        <div class="text-right mt-6 font-semibold text-yellow-300">
          Refunded Commission:&nbsp;${{ number_format($refundedCommission, 2) }}
        </div>
      @endif

      {{-- Net commission --}}
      <div class="text-right mt-6 font-semibold text-yellow-300">
        Net Commission:&nbsp;${{ number_format($netCommission, 2) }}
      </div>
    </div>
  </div>
</x-app-layout>
