<x-app-layout>
  <div class="py-12 bg-[#1f1c27] text-white min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <x-affiliate.submenu />

      <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl p-6">

        <h3 class="text-2xl font-bold text-yellow-300 mb-6">Your Commissions</h3>

        {{-- Month selector --}}
        <form method="GET" action="{{ url('/affiliate/commission') }}" class="mb-6">
          <select name="month"
                  onchange="this.form.submit()"
                  class="bg-gray-800 text-white px-3 py-2 rounded-lg">
            @foreach($months as $value => $label)
              <option value="{{ $value }}" {{ $value === $currentMonth ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </form>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800 text-yellow-300">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Commission</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Due Date</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase">Paid At</th>
              </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-700">
              @forelse($commissions as $c)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    ${{ number_format($c->amount, 2) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ $c->due_date->format('M j, Y') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                      {{ $c->status === 'paid'   ? 'bg-green-600 text-green-100'
                         : ($c->status === 'pending' ? 'bg-yellow-600 text-yellow-100'
                         : 'bg-red-600 text-red-100') }}">
                      {{ ucfirst($c->status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ $c->paid_at ? $c->paid_at->format('M j, Y') : '-' }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                    No commissions for this month.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Total for month --}}
        <div class="text-right mt-6 font-semibold text-yellow-300">
          Total: ${{ number_format($commissions->sum('amount'), 2) }}
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
