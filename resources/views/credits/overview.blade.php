<x-app-layout>


  <div class="py-12 bg-[#1f1c27] min-h-screen text-white">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total --}}
        <div class="p-6 bg-gray-900 rounded-2xl shadow-2xl">
          <h3 class="text-lg font-medium text-gray-400">Total Credits</h3>
          <p class="text-4xl font-bold text-yellow-300">{{ $total }}</p>
        </div>

        {{-- Base --}}
        <div class="p-6 bg-gray-900 rounded-2xl shadow-2xl">
          <h3 class="text-lg font-medium text-gray-400">Your Credits</h3>
          <p class="text-4xl font-bold text-yellow-300">{{ $base }}</p>
        </div>

        {{-- Downline --}}
        <div class="p-6 bg-gray-900 rounded-2xl shadow-2xl">
          <h3 class="text-lg font-medium text-gray-400">Downline Credits</h3>
          <p class="text-4xl font-bold text-yellow-300">{{ $downline }}</p>
        </div>
      </div>

      {{-- Breakdown by type --}}
      <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl p-6">
        <h3 class="text-2xl font-bold text-yellow-300 mb-4">Credits by Type</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-900 text-yellow-300">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Type</th>
                <th class="px-6 py-3 text-right text-xs font-semibold uppercase">Total</th>
              </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
              @foreach($byType as $row)
                @php
                  // detect downline types and build labels
                  $isDownline = \Illuminate\Support\Str::startsWith($row->type, 'downline_');
                  $label = $isDownline
                    ? \Illuminate\Support\Str::of($row->type)
                        ->replace('downline_', '')
                        ->replace('_', ' ')
                        ->title()
                    : \Illuminate\Support\Str::of($row->type)
                        ->replace('_', ' ')
                        ->title();
                @endphp
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ $label }}
                    @if($isDownline)
                      <span class="ml-1 text-xs text-gray-400">(downline)</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    {{ $row->total }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</x-app-layout>
