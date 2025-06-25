<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-yellow-300">Your Credits</h2>
  </x-slot>

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
        {{-- Spillover --}}
        <div class="p-6 bg-gray-900 rounded-2xl shadow-2xl">
          <h3 class="text-lg font-medium text-gray-400">Spill-over Credits</h3>
          <p class="text-4xl font-bold text-yellow-300">{{ $spillover }}</p>
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
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ Str::of($row->type)->replace('_spillover','')->replace('_',' ')->title() }}
                    @if(str_ends_with($row->type,'_spillover'))
                      <span class="ml-1 text-xs text-gray-400">(spill-over)</span>
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
