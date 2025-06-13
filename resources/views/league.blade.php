
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FDFDFC] overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-[#FDFDFC]">


                    <div class="flex justify-around">
                        <div>

                          <h1 class="mt-2  text-4xl font-medium text-gray-900 ">
                            <!-- invisible icon -->
                            🏆
                            <!-- end invisible icon -->
                            Official Sell Or Die League Rankings For {{ $humanPeriod }}

                        </h1>

                    </div>

<!-- 
<div x-data="{ open: false, selected: 'Today' }" class="relative inline-block text-left z-50">
  <button @click="open = !open"
    class="inline-flex justify-between items-center w-48 bg-[#04cef6] hover:bg-[#03b8de] text-white font-semibold py-2 px-4 rounded-md shadow-md">
    <span x-text="selected"></span>
    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <div
    x-show="open"
    x-transition
    @click.away="open = false"
    class="absolute z-50 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200"
    style="max-height: 300px; overflow-y: auto;"
  >
    <ul class="text-gray-700 text-sm py-1">

      <li><a @click="selected = 'Today'; open = false" href="/league/today" class="block px-4 py-2 hover:bg-gray-100">Today</a></li>
      <li><a @click="selected = 'Yesterday'; open = false" href="/league/yesterday" class="block px-4 py-2 hover:bg-gray-100">Yesterday</a></li>
      <li><a @click="selected = 'This Week'; open = false" href="/league/thisweek" class="block px-4 py-2 hover:bg-gray-100">This Week</a></li>
      <li><a @click="selected = 'Last Week'; open = false" href="/league/lastweek" class="block px-4 py-2 hover:bg-gray-100">Last Week</a></li>
      <li><a @click="selected = 'This Month'; open = false" href="/league/thismonth" class="block px-4 py-2 hover:bg-gray-100">This Month</a></li>
      <li><a @click="selected = 'Last Month'; open = false" href="/league/lastmonth" class="block px-4 py-2 hover:bg-gray-100">Last Month</a></li>
      <li><a @click="selected = 'All'; open = false" href="/league/all" class="block px-4 py-2 hover:bg-gray-100">All</a></li>      
    </ul>
  </div>
</div> -->


<div>

    @php
    $url = url()->current();
    $bits = explode("/",$url);
    $selectedRange = request('range', $bits[4]); // default to 'today' if not set
    @endphp

    <div x-data="{ 
        open: false, 
        selected: '{{ ucwords(str_replace('-', ' ', $selectedRange)) }}' 
    }" 
    class="relative inline-block text-left z-50"
    >
    <button @click="open = !open"
    class="inline-flex justify-between items-center w-48 bg-[#04cef6] hover:bg-[#03b8de] text-white font-semibold py-2 px-4 rounded-md shadow-md">
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
    @foreach (['all', 'today', 'yesterday', 'thisweek', 'lastweek', 'thismonth', 'lastmonth'] as $range)
    <li>
        <a 
        @click="selected = '{{ ucwords(str_replace('-', ' ', $range)) }}'; open = false" 
        href="{{ $range }}"
        class="block px-4 py-2 hover:bg-[#04cef6] hover:text-white 
        {{ $selectedRange === $range ? 'bg-[#04cef6] text-white' : '' }}">
        {{ ucwords(str_replace('-', ' ', $range)) }}
    </a>
</li>
@endforeach
</ul>
</div>
</div>





</div>
</div>




<!-- <p>have different stats for different member status (lightweigjtl  bantam wegith etc)</p> -->

<!-- <a href="/league/today">
<button class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium px-3 py-1.5 rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
    <path d="M10 3h1v4H9V3zm0 5h1v4H9V8zm0 5h1v2H9v-2z" />
  </svg>
 
 Today
</button>
</a>
           -->      <!-- <a href="/league/today"><x-button>Today</x-button></a>
                <a href="/league/yesterday"><x-button>Yesterday</x-button></a>
                <a href="/league/thisweek"><x-button>This Week</x-button></a>
                <a href="/league/lastweek"> <x-button>Last Week</x-button></a>
                <a href="/league/thismonth"> <x-button>This Month</x-button></a>
                <a href="/league/lastmonth">   <x-button>Last Month</x-button></a>
                <a href="/league/all">   <x-button>All Time</x-button></a> -->

                <p>&nbsp;</p>
                <!-- Primary Action Button -->
<!-- <button class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-yellow-400">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4" />
  </svg>
  View Match
</button> -->

<!-- Secondary Detail Button -->
<!-- <button class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium px-3 py-1.5 rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
    <path d="M10 3h1v4H9V3zm0 5h1v4H9V8zm0 5h1v2H9v-2z" />
  </svg>
  View Stats
</button> -->




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
<!--           <a href="/fights/show/{{ $fight->id }}" target="_blank" class="text-cyan-400 font-medium hover:underline">
            {{ $fight->name }}
        </a> -->
        <a href="/new-fight/show/{{ $fight->id }}" target="_blank" class="text-cyan-400 font-medium hover:underline">
          <button class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-yellow-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4" />
            </svg>
            {{ $fight->name }}
        </button>
    </a>
</td>
<td class="px-4 py-3">{{ $fight->fightOwner->name }}</td>
<td class="px-4 py-3">{{ $fight->opponent->name ?? '—' }}</td>
<td class="px-4 py-3">{{ $fight->ad->headline ?? '—' }}</td>
<td class="px-4 py-3">{{ $fight->opponentsAd->headline ?? '—' }}</td>
<td class="px-4 py-3 text-center">{{ $fight->views }}</td>
<td class="px-4 py-3 text-center">{{ $fight->clicks }}</td>
<td class="px-4 py-3 text-center">{{ $fight->opponentsClicks }}</td>
<td class="px-4 py-3 text-center font-semibold text-green-400">{{ number_format($fight->winLoss * 100, 2) }}%</td>
</tr>
@endforeach
</tbody>
</table>
</div>






<div class="mt-20">











<!-- 
                <p>

                    Daily Rankoings
                    msot e3ffect ad of the hours
                    who has the most effective ad today?
                    this week?
                    this month?
                    this year?
                    all time?
                    so now thesre' incentive for peooe
                    b/c  they'll get feeatured at the top10
                </p>

                <p>


                    <b>
                        people want to know, which ad sells the best
                        that's the popint of this sitre
                    find your winner ad  and then roll out withit </b>
                </p>


                <br>
            best performing ad </br>
            best performing fighter 
            <br>
            Daily Contests<br>
            Weekly Contest <br>
            Who has the  better aed
            sell or die .online
            do you have rthe courage to pit your best ad amongs the very best aed fighters in the leauge?
            invite your friends, see who has the better program, better ocnvresion rate

            here's the thing, when somone is given an option, and then choose that optino, they will act
            afterwards in congruency with thischoice, and so if they pick your ad, and the windows pops
            up to click again they are in effect targeted
            Foot in the door dconcept
            putting signs on your lawn concept
            I think tha'ts fro mscientifidc advertising

            edownload sci ad to your phone -->
        </div>


    </div>

</div>
</div>
</x-app-layout>



