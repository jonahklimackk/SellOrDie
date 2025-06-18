<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <!-- Page Header & Dropdown -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-medium text-gray-900 flex items-center">
          <!-- invisible icon -->
          🏆
          <!-- end invisible icon -->
          <span class="ml-2 text-white">Official Sell Or Die League Rankings For {{ $humanPeriod }}</span>
        </h1>

        @php
          $url = url()->current();
          $bits = explode("/", $url);
          $selectedRange = request('range', $bits[4]);
        @endphp
        <div
          x-data="{ 
            open: false, 
            selected: '{{ ucwords(str_replace('-', ' ', $selectedRange)) }}' 
          }"
          class="relative inline-block text-left z-50"
        >
          <button
            @click="open = !open"
            class="inline-flex justify-between items-center w-48 bg-[#04cef6] hover:bg-[#03b8de] text-white font-semibold py-2 px-4 rounded-md shadow-md"
          >
            <span x-text="selected"></span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div
            x-show="open"
            x-transition
            @click.away="open = false"
            class="absolute z-50 mt-2 w-48 bg-[#e0faff] text-[#042a2b] rounded-md shadow-lg border border-[#04cef6]"
            style="max-height: 300px; overflow-y: auto;"
          >
            <ul class="text-sm py-1">
              @foreach (['all','today','yesterday','thisweek','lastweek','thismonth','lastmonth'] as $range)
                <li>
                  <a
                    @click="selected = '{{ ucwords(str_replace('-', ' ', $range)) }}'; open = false"
                    href="{{ $range }}"
                    class="block px-4 py-2 hover:bg-[#04cef6] hover:text-white {{ $selectedRange === $range ? 'bg-[#04cef6] text-white' : '' }}"
                  >
                    {{ ucwords(str_replace('-', ' ', $range)) }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <!-- Rankings Table -->
      <div class="overflow-x-auto rounded-xl shadow-2xl border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-700 text-sm text-gray-300">
          <thead class="bg-gray-800 sticky top-0 z-10">
            <tr>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Rank</th>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Fight Name / View Fight</th>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Fighter</th>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Opponent</th>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Fight Ad</th>
              <th class="px-4 py-3 text-left text-yellow-400 font-semibold">Opponent Ad</th>
              <th class="px-4 py-3 text-center text-yellow-400 font-semibold">Fights</th>
              <th class="px-4 py-3 text-center text-yellow-400 font-semibold">Wins</th>
              <th class="px-4 py-3 text-center text-yellow-400 font-semibold">Losses</th>
              <th class="px-4 py-3 text-center text-yellow-400 font-semibold">Win %</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800">
            @foreach($fights as $fight)
              <tr class="hover:bg-gray-800 transition-colors">
                <td class="px-4 py-3 text-center">{{ $loop->index + 1 }}</td>
                <td class="px-4 py-3">
                  <a href="/new-fight/show/{{ $fight->id }}" target="_blank" class="inline-flex items-center gap-2 text-cyan-400 font-medium hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
                    </svg>
                    {{ $fight->name }}
                  </a>
                </td>
                <td class="px-4 py-3">{{ $fight->fightOwner->name }}</td>
                <td class="px-4 py-3">{{ $fight->opponent->name ?? '—' }}</td>
                <td class="px-4 py-3">{{ $fight->ad->headline ?? '—' }}</td>
                <td class="px-4 py-3">{{ $fight->opponentsAd->headline ?? '—' }}</td>
                <td class="px-4 py-3 text-center">{{ $fight->views }}</td>
                <td class="px-4 py-3 text-center">{{ $fight->clicks }}</td>
                <td class="px-4 py-3 text-center">{{ $fight->opponentsClicks }}</td>
                <td class="px-4 py-3 text-center font-semibold text-green-400">
                  {{ number_format($fight->winLoss * 100, 2) }}%
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-20">
        <!-- Any additional content here -->
      </div>

    </div>
  </div>
</x-app-layout>
