<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-bold text-yellow-300">Your Referral Sales</h2>
  </x-slot>

  <div class="py-8 bg-[#1f1c27] min-h-screen text-white">
    <div class="max-w-4xl mx-auto bg-gray-900 p-6 rounded-2xl shadow-2xl">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-800 text-yellow-300">
          <tr>
            <th class="px-4 py-2 text-left">Referral</th>
            <th class="px-4 py-2 text-left">Product</th>
            <th class="px-4 py-2 text-right">Amount</th>
            <th class="px-4 py-2 text-right">Date</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
          @forelse($sales as $sale)
            <tr>
              <td class="px-4 py-2">{{ $sale->buyer->name }}</td>
              <td class="px-4 py-2">{{ $sale->product }}</td>
              <td class="px-4 py-2 text-right">${{ number_format($sale->amount,2) }}</td>
              <td class="px-4 py-2 text-right">{{ $sale->created_at->format('M j, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                No referral sales yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
