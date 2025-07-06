<x-app-layout>
  <div class="py-8 bg-[#1f1c27] min-h-screen text-white">
    <x-affiliate.submenu />

    <div class="max-w-4xl mx-auto bg-gray-900 p-6 rounded-2xl shadow-2xl">
      <h3 class="text-2xl font-bold text-yellow-300 mb-6">
        Monthly Commissions
      </h3>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
          <thead class="bg-gray-800 text-yellow-300">
            <tr>
              <th class="px-4 py-2 text-left">Month/Year</th>
              <th class="px-4 py-2 text-right">Amount</th>
              <th class="px-4 py-2 text-center">Status</th>
            </tr>
          </thead>
          <tbody class="bg-gray-900 divide-y divide-gray-700">
            @forelse($rows as $row)
              <tr>
                <td class="px-4 py-2">
                  {{ \Carbon\Carbon::create($row->year, $row->month, 1)->format('F Y') }}
                </td>
                <td class="px-4 py-2 text-right font-semibold text-yellow-300">
                  ${{ number_format($row->amount, 2) }}
                </td>
                <td class="px-4 py-2 text-center">
                  <span class="px-2 py-1 rounded-full 
                    {{ $row->status === 'paid' ? 'bg-green-600' : 'bg-yellow-600' }}">
                    {{ ucfirst($row->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                  No commission entries yet.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
