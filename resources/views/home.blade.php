<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <!-- Cards Row: Welcome + Overview -->
      <div class="flex flex-col md:flex-row gap-6 mb-12">
        <!-- Welcome Card -->
        <div class="w-full md:w-1/2 bg-gray-800 shadow-xl rounded-xl p-6 text-center">
          <h2 class="text-2xl font-bold text-yellow-300 mb-2">
            👋 Welcome to the Sell Or Die Arena, {{ Auth::user()->name ?? 'Champion' }}!
          </h2>
          <p class="text-gray-200 text-lg">
            You’ve entered the big leagues. Track your stats, climb the rankings, and let your ads do the talking.
            Remember—every vote, every click, every fight counts.
          </p>
        </div>

        <!-- Account Overview Card -->
        <div class="w-full md:w-1/2 bg-gray-800 p-6 rounded-2xl shadow-xl">
          <h2 class="text-2xl font-bold text-yellow-300 mb-4">📋 Account Overview</h2>
          <table class="w-full table-auto text-left text-sm text-gray-100">
            <tbody>
              <tr class="border-b border-gray-700">
                <th class="py-2 px-4 font-medium text-yellow-200">Membership</th>
                <td class="py-2 px-4">{{ Auth::user()->status }}</td>
              </tr>
              <tr class="border-b border-gray-700">
                <th class="py-2 px-4 font-medium text-yellow-200">Total Credits</th>
                <td class="py-2 px-4">{{ Auth::user()->credits }}</td>
              </tr>
              <tr class="border-b border-gray-700">
                <th class="py-2 px-4 font-medium text-yellow-200">Credits Earned Today</th>
                <td class="py-2 px-4">{{ $creditsSurfed }}</td>
              </tr>
              <tr>
                <th class="py-2 px-4 font-medium text-yellow-200">Fights Judged Today</th>
                <td class="py-2 px-4">{{ $fightsJudged }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Your Fights Header -->
      <div class="bg-gray-800 shadow-xl rounded-xl p-6 mb-6 text-center">
        <h2 class="text-2xl font-bold text-yellow-300 mb-2">🥊 Your Fights</h2>
      </div>

      <!-- Fights Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto max-w-6xl p-4">
        @foreach ($data as $key => $item)
        @continue($data[$key]['unowned'])


        <form method="POST" action="{{ route('current-team.update') }}" x-data class="w-full">
          @method('PUT')
          @csrf
          <input type="hidden" name="team_id" value="{{ $data[$key]['fight']->id }}">

          <a href="#" x-on:click.prevent="$root.submit()">
            <div class="bg-gray-800 shadow-2xl hover:shadow-yellow-400/30 hover:ring-2 hover:ring-yellow-300 transition-all rounded-xl p-5 space-y-4">
              <!-- Header with Image and Title -->
              <div class="flex items-center gap-4 justify-between">
                <img src="/img/boxingglove.png" width="80" height="80" alt="Boxing Glove" class="rounded-md shadow-md" />
                <div class="text-yellow-300 text-2xl font-bold truncate">
                  {{ $data[$key]['fight']->name }} 
                </div>

                @php
                $isLive = $data[$key]['status'] === 'live';
                @endphp

                @if($isLive)
                <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold uppercase">
                  Live
                  <!-- pulsing “live” dot -->
                  <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-3 w-3 animate-ping text-green-500"
                  viewBox="0 0 8 8"
                  fill="currentColor">
                  <circle cx="4" cy="4" r="3" />
                </svg>
              </span>
              @else
              <!-- fallback for non-live statuses -->
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full text-xs font-semibold uppercase">
                {{ $data[$key]['status'] }}
              </span>
              @endif

            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-3 gap-2 bg-yellow-500/10 p-4 rounded-lg text-sm font-medium text-gray-100">
              <div>Fights:</div><div></div><div>{{ App\Models\FightViewLog::getViews($data[$key]['fight']->id,'all') ?? 0 }}</div>

              @if(isset($data[$key]['opponentsAd']))
              <div>{{ $data[$key]['opponentsAd']->user->name }}'s Clicks:</div><div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0 }}</div>
              @else
              <div>Opponent's Clicks:</div><div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0 }}</div>
              @endif

              <div>Your Clicks:</div><div></div><div>{{ $data[$key]['clicks'] ?? 0 }}</div>
              <div>Your Record:</div><div></div><div>{{ $data[$key]['clicks'] ?? 0 }} - {{ $data[$key]['opponentsClicks'] ?? 0 }} - {{ $data[$key]['draws'] ?? 0 }}</div>
              <div>Win Percentage:</div><div></div><div>{{ $data[$key]['winLoss'] ?? 0 }}%</div>

              @if (Auth::user()->currentTeam->status == 'live')
              <div>Daily Ranking:</div><div></div><div>{{ $data[$key]['ranking'] ?? 'n/a' }} place</div>
              @else
              <div>Daily Ranking:</div><div></div><div>n/a</div>
              @endif

              <div>Status:</div><div></div><div>{{ $data[$key]['status'] }}</div>
            </div>
          </div>
        </a>
      </form>
      @endforeach
    </div>

    <!-- Your Fights Header -->
    <div class="bg-gray-800 shadow-xl rounded-xl p-6 mb-6 text-center">
      <h2 class="text-2xl font-bold text-yellow-300 mb-2">🥊 Fights You've Joined </h2>
    </div>



    <!-- Fights Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto max-w-6xl p-4">
      @foreach ($data as $key => $item)
      @continue(!$data[$key]['unowned'])
      <form method="POST" action="{{ route('current-team.update') }}" x-data class="w-full">
        @method('PUT')
        @csrf
        <input type="hidden" name="team_id" value="{{ $data[$key]['fight']->id }}">

        <a href="#" x-on:click.prevent="$root.submit()">
          <div class="bg-gray-800 shadow-2xl hover:shadow-yellow-400/30 hover:ring-2 hover:ring-yellow-300 transition-all rounded-xl p-5 space-y-4">
            <!-- Header with Image and Title -->
            <div class="flex items-center gap-4 justify-between">
              <img src="/img/boxingglove.png" width="80" height="80" alt="Boxing Glove" class="rounded-md shadow-md" />
              <div class="text-yellow-300 text-2xl font-bold truncate">
                {{ $data[$key]['fight']->name }} 
              </div>
                @php
                $isLive = $data[$key]['status'] === 'live';
                @endphp

                @if($isLive)
                <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold uppercase">
                  Live
                  <!-- pulsing “live” dot -->
                  <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-3 w-3 animate-ping text-green-500"
                  viewBox="0 0 8 8"
                  fill="currentColor">
                  <circle cx="4" cy="4" r="3" />
                </svg>
              </span>
              @else
              <!-- fallback for non-live statuses -->
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-gray-200 text-gray-700 rounded-full text-xs font-semibold uppercase">
                {{ $data[$key]['status'] }}
              </span>
              @endif
              
            </div>



            <!-- Stats Grid -->
            <div class="grid grid-cols-3 gap-2 bg-yellow-500/10 p-4 rounded-lg text-sm font-medium text-gray-100">
              <div>Fights:</div><div></div><div>{{ App\Models\FightViewLog::getViews($data[$key]['fight']->id,'all') ?? 0 }}</div>

              @if(isset($data[$key]['opponentsAd']))
              <div>{{ $data[$key]['opponentsAd']->user->name }}'s Clicks:</div><div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0 }}</div>
              @else
              <div>Opponent's Clicks:</div><div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0 }}</div>
              @endif

              <div>Your Clicks:</div><div></div><div>{{ $data[$key]['clicks'] ?? 0 }}</div>
              <div>Your Record:</div><div></div><div>{{ $data[$key]['clicks'] ?? 0 }} - {{ $data[$key]['opponentsClicks'] ?? 0 }} - {{ $data[$key]['draws'] ?? 0 }}</div>
              <div>Win Percentage:</div><div></div><div>{{ $data[$key]['winLoss'] ?? 0 }}%</div>

              @if (Auth::user()->currentTeam->status == 'live')
              <div>Daily Ranking:</div><div></div><div>{{ $data[$key]['ranking'] ?? 'n/a' }} place</div>
              @else
              <div>Daily Ranking:</div><div></div><div>n/a</div>
              @endif

              <div>Status:</div><div></div><div>{{ $data[$key]['status'] }}</div>
            </div>
          </div>
        </a>
      </form>
      @endforeach
    </div>


  </div>
</div>
</x-app-layout>
