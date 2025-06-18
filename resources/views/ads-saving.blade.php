<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Description & Stats Row -->
      <div class="flex flex-col md:flex-row gap-6 mb-8">
        <!-- Description Panel -->
        <div class="w-full md:w-2/3 bg-gray-800 shadow-xl rounded-xl p-6">
          <h2 class="text-2xl font-bold text-yellow-300 mb-4">
            Welcome To {{ Auth::user()->currentTeam->name }}
          </h2>
          <p class="text-gray-200 leading-relaxed mb-6">
            If you’re serious about becoming the ultimate Fighter in the Sell or Die arena, you need a weapon that delivers a knockout every time. Your ad-weapon should land that perfect 1-2 punch to blow past the competition!

            In Sell or Die, a “Fight” is simply how many times your weapon’s been unleashed—either counted as views or as activations when you wield it. Each Fight pits two fighters and their chosen weapons head-to-head. Challenge an opponent, and once they accept, you’ll get a custom URL to showcase your matchup. As fellow fighters surf and earn credits, they’ll see your battle live in the leaderboard.

            Ready to prove you’ve got the fiercest ad-weapon in the ring? Gear up, lock in your Fight URL, and let the best ad win!
          </p>

          @if (Auth::user()->status === 'heavyweight')
            <a href="#"
               class="inline-block bg-[#04cef6] hover:bg-[#039ac0] text-white font-semibold px-4 py-2 rounded transition">
              Use AI to create the ad for you.
            </a>
          @else
            <a href="#"
               class="inline-block bg-[#04cef6] hover:bg-[#039ac0] text-white font-semibold px-4 py-2 rounded transition">
              Upgrade to Heavyweight – paste your URL and get a beautiful fighter card generated for you.
            </a>
          @endif
        </div>

        <!-- Stats Panel with centered button on top -->
        <div class="w-full md:w-1/3 relative">
          <!-- Button positioned above the card -->

<!--           <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <x-red-button>Start Fight</x-red-button>
          </div>
 -->
 <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    @if((isset($ad) && isset($opponentsAd) || (isset($ad->random_opponent) && $ad->random_opponent)) && Auth::user()->currentTeam->status != 'live')
                        <form action="/fight/start/" method="POST">
                           <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? ''}}">
                           @csrf
                           <x-red-button>
                            Start Fight
                        </x-red-button>
                    </form> 
                
                @elseif(Auth::user()->currentTeam->status == 'live')
                    <form action="/fight/stop/" method="POST">
                       <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? ''}}">
                       @csrf
                       <x-red-button>
                        Fight is Live!
                    </x-red-button>
                </form> 
                        

            @else
                <x-red-button disabled>
                    Start Fight
                </x-red-button>
            @endif 
          </div>

          <div class="bg-gray-800 shadow-2xl rounded-xl p-6 pt-12 text-sm font-medium text-gray-100 space-y-4">
            <h2 class="text-2xl font-bold text-yellow-300 mb-2">
              {{ Auth::user()->currentTeam->name }} Stats
            </h2>
            <div class="grid grid-cols-[auto_1fr_auto] gap-2">
              <div class="whitespace-nowrap">Fights:</div><div></div><div>{{ App\Models\FightViewLog::getViews($fight->id, 'all') ?? 0 }}</div>

              @if(isset($opponentsAd))
                <div class="whitespace-nowrap">{{ $opponentsAd->user->name }}'s Clicks:</div><div></div><div>{{ $opponentsClicks ?? 0 }}</div>
              @else
                <div class="whitespace-nowrap">Opponent's Clicks:</div><div></div><div>{{ $opponentsClicks ?? 0 }}</div>
              @endif

              <div class="whitespace-nowrap">Your Clicks:</div><div></div><div>{{ $clicks ?? 0 }}</div>

              <div class="whitespace-nowrap">Your Record:</div><div></div><div>{{ $clicks ?? 0 }} - {{ $opponentsClicks ?? 0 }} - {{ $draws ?? 0 }}</div>

              <div class="whitespace-nowrap">Win Percentage:</div><div></div><div>{{ $winLoss ?? 0 }}%</div>

              @if (Auth::user()->currentTeam->status == 'live')
                <div class="whitespace-nowrap">Daily Ranking:</div><div></div><div>{{ $ranking ?? 'n/a' }} place</div>
              @else
                <div class="whitespace-nowrap">Daily Ranking:</div><div></div><div>n/a</div>
              @endif

              <div class="whitespace-nowrap">Status:</div><div></div><div>{{ Auth::user()->currentTeam->status }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-wrap gap-4 mb-8">
        <button class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition">
          Primary Action
        </button>
        <button class="px-5 py-2 border border-[#04cef6] hover:bg-[#eefcff] text-[#04cef6] rounded font-medium transition">
          Secondary Action
        </button>
      </div>

      <!-- Two Fighter Cards (VS page style) -->
      <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
        <!-- Fighter Card 1 -->
        <div
          class="flex flex-col items-start gap-6 rounded-lg bg-white text-black p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:p-10 lg:pb-10"
          style="cursor: pointer;"
          onclick=""
        >
          <div class="flex items-center gap-6">
            <img
              src="{{ $ad->user->profile_photo_url }}"
              alt="{{ $ad->user->name }}"
              class="w-20 h-20 rounded-full object-cover"
            />
            <h1 class="text-5xl font-semibold text-black">
              {{ $ad->headline }}
            </h1>
          </div>
          <div class="mt-2">
            {!! nl2br($ad->body) !!}
          </div>
        </div>

        @if(isset($opponentsAd) || $ad->random_opponent)
          <!-- Fighter Card 2 -->
          <div
            class="flex flex-col items-start gap-6 rounded-lg bg-white text-black p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:p-10 lg:pb-10"
            style="cursor: pointer;"
            onclick=""
          >
            <div class="flex items-center gap-6">
              <img
                src="{{ isset($opponentsAd) ? $opponentsAd->user->profile_photo_url : '/anonymous.png' }}"
                alt="{{ isset($opponentsAd) ? $opponentsAd->user->name : 'Random Opponent' }}"
                class="w-20 h-20 rounded-full object-cover"
              />
              <h1 class="text-5xl font-semibold text-black">
                {{ isset($opponentsAd) ? $opponentsAd->headline : 'Random Opponent' }}
              </h1>
            </div>
            @if(isset($opponentsAd))
              <div class="mt-2">
                {!! nl2br($opponentsAd->body) !!}
              </div>
            @endif
          </div>
        @endif
      </div>

    </div>
  </div>
</x-app-layout>
