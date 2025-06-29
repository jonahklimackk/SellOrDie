<x-app-layout>
  <x-slot name="header">
    <h2 class="font-montserrat text-2xl text-sod-yellow leading-tight">
      Affiliate Program Stats
    </h2>
  </x-slot>

  <div class="min-h-screen bg-sod-bg text-gray-100 px-6 py-8 font-sans">
    @if($stats->isEmpty())
      <p class="text-gray-400">You have no affiliate sales yet.</p>
    @else
      <!-- Centered, 3/4 width wrapper -->
      <div class="overflow-x-auto w-3/4 mx-auto">
        <table class="w-full bg-sod-panel border border-sod-yellow rounded-2xl shadow-lg">
          <thead>
            <tr class="bg-sod-yellow">
              <th class="px-6 py-3 text-left text-black font-montserrat">Buyer</th>
              <th class="px-6 py-3 text-left text-black font-montserrat">Email</th>
              <th class="px-6 py-3 text-right text-black font-montserrat">Sales</th>
              <th class="px-6 py-3 text-right text-black font-montserrat">Total Sales</th>
              <th class="px-6 py-3 text-right text-black font-montserrat">Total Commissions</th>
              <th class="px-6 py-3 text-left text-black font-montserrat">Details</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stats as $stat)
            <tr class="border-t border-gray-700 hover:bg-gray-700">
              <td class="px-6 py-4 text-white font-semibold">{{ $stat->buyer->name }}</td>
              <td class="px-6 py-4 text-gray-400">{{ $stat->buyer->email }}</td>
              <td class="px-6 py-4 text-right text-sod-yellow font-bold">{{ $stat->count }}</td>
              <td class="px-6 py-4 text-right text-sod-yellow font-bold">${{ number_format($stat->totalAmount,2) }}</td>
              <td class="px-6 py-4 text-right text-sod-yellow font-bold">${{ number_format($stat->totalCommission,2) }}</td>
              <td class="px-6 py-4">
                <ul class="list-disc list-inside text-gray-300 space-y-1">
                  @foreach($stat->details as $detail)
                    <li>{{ $detail }}</li>
                  @endforeach
                </ul>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</x-app-layout>
