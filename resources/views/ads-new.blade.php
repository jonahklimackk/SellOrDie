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

          @if(isset($create) || !isset($ad))
          <div class="max-w-lg mx-auto bg-gradient-to-r from-red-400 to-red-600 rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition">
            <div class="flex items-center p-6">
              <!-- AI icon -->
              <div class="flex-1">
                @if (Auth::user()->status === 'heavyweight')
                <a
                href="#"
                class="inline-flex items-center bg-white hover:bg-gray-100 text-blue-600 font-semibold px-4 py-2 rounded-lg shadow"
                >
                <img
                src="/img/icon-aiad.png"
                alt=""
                class="w-10 h-10 mr-2"
                />
                Use AI to create the ad for you
              </a>
              @else
              <a
              href="#"
              class="inline-flex items-center bg-white hover:bg-gray-100 text-blue-600 font-semibold px-4 py-2 rounded-lg shadow"
              >
              <img
              src="/img/icon-aiad.png"
              alt=""
              class="w-10 h-10 mr-2"
              />
              Upgrade to Heavyweight – All you have to do is list your url and it generates a beautiful fighter card for you in seconds
            </a>
            @endif
          </div>
        </div>
      </div>
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
           <button type="submit"
           class="inline-flex items-center justify-center gap-2
           px-6 py-3 bg-red-600 hover:bg-red-700
           text-white font-bold uppercase tracking-wide
           rounded-full shadow-lg transition-all duration-200 ease-in-out
           focus:outline-none
           ring-2 ring-offset-2 ring-yellow-400      <!-- always-on ring -->
           group">
           <span class="text-xl transform transition-transform duration-300 group-hover:animate-bounce">
            🥊
          </span>
          <span>Start Fight</span>
        </button>

      </form> 

      @elseif(Auth::user()->currentTeam->status == 'live')
      <form action="/fight/stop/" method="POST">
       <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? ''}}">
       @csrf
       <button type="submit"
       class="inline-flex items-center justify-center gap-2
       px-6 py-3 bg-red-600 hover:bg-red-700
       text-white font-bold uppercase tracking-wide
       rounded-full shadow-lg transition-all duration-200 ease-in-out
       focus:outline-none
       ring-2 ring-offset-2 ring-yellow-400      <!-- always-on ring -->
       group">
       <span class="text-xl transform transition-transform duration-300 group-hover:animate-bounce">
        🥊
      </span>
      <span>Fight Is Live!</span>
    </button>
  </form> 


  @else
  <button
  type="submit"
  disabled
  class="
  inline-flex items-center justify-center gap-2
  px-6 py-3
  bg-red-600 hover:bg-red-700 disabled:bg-red-400 disabled:hover:bg-red-400
  text-white font-bold uppercase tracking-wide
  rounded-full shadow-lg disabled:shadow-none
  transition-all duration-200 ease-in-out
  focus:outline-none
  ring-2 ring-offset-2 ring-yellow-400 disabled:ring-0
  disabled:opacity-60 disabled:cursor-not-allowed
  group
  "
  >
  <span
  class="text-xl transform transition-transform duration-300
  group-hover:animate-bounce disabled:group-hover:animate-none"
  >
  🥊
</span>
<span>Start Fight</span>
</button>
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

  @if(!(!$opponentsClicks && !$clicks && !Auth::user()->currentTeam->views))
  <div class="text-center pt-4">
    <form action="/fight/reset" method="POST">
      @csrf
      <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? '' }}">
      <x-button class="bg-yellow-400 hover:bg-yellow-300 text-black font-semibold px-4 py-2 rounded-md shadow-md transition">
        Reset
      </x-button>
    </form>
  </div>
  @endif
</div>
</div>
</div>

<!-- Action Buttons -->
<div class="flex flex-wrap gap-20 mb-8 justify-between">

  <h2 class="text-2xl font-bold text-yellow-300 mb-4">
  {{ url()->previous() }}
</h2>



 <!-- h2 class="text-2xl font-bold text-yellow-300 mb-4">
  {{ $ad }}
</h2>


 <h2 class="text-2xl font-bold text-yellow-300 mb-4">
  {{ $opponentsAd }}
</h2> -->
@unless(strstr(url()->current(),"edit") || strstr(url()->previous(),"teams/create") || !$ad)  

  <form action="/ads/edit" method="GET">
    <button class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition">
      Edit Ad
    </button>
  </form>


@if(isset($ad) && !isset($opponentsAd))
  <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
    <button class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition">
      Invite Opponent
    </button>
  </form>
  @endif

@if(isset($ad) && !isset($opponentsAd) && !$ad->random_opponent)
  <form action="/ads/random-opponent/" method="POST">
   <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
   @csrf
   <button class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition">
    Random Opponent 
  </button>
</form> 
@endif

@if(isset($ad) && isset($opponentsAd))
  <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
    <button class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition">
      @if($fight->user_id == Auth::user()->id)
      Remove Opponent
      @else
      Leave Fight
      @endif
    </button>
  </form>
@endif

@endunless

</div>


<div class="mb-6"><font color="red"><b>{{ session('red_message') ?? ''}}</b></font></div>
<div class="mb-6"><font color="yellow"><b>{{ session('green_message') ?? ''}}</b></font></div>


@if(is_null($ad) || isset($edit) )
<div class="mt-6 mb-6">
  <ul>
    @foreach($errors->all() as $error)
    <li><font color="red">{{ $error }}</font></li>
    @endforeach
  </ul>                      
</div>



<!-- <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"> -->
  <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
    <div class="px-6 py-4">

      <!-- Ad fields form (hidden submit) -->
      <form method="POST" action="/ads/create" id="ad-data-form">
        @csrf
        <div class="grid grid-cols-1 gap-6">
          <p class="text-white font-semibold">Headline</p>
          <x-input
          name="headline"
          placeholder="Your Headline Here"
          value="{{ $ad->headline ?? old('headline') ?? '' }}"
          />

          <p class="text-white font-semibold">Category</p>
          <select
          name="category"
          class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
          >
          <option>Select Category</option>
          @foreach($categories as $category)
          <option
          {{ (!is_null($ad) && $ad->category == $category->category) ? 'selected' : '' }}
          >
          {{ $category->category }}
        </option>
        @endforeach
      </select>

      @if(Auth::user()->status != 'free')
      <script>
        tinymce.init({
          selector: 'textarea',
          plugins:
          'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar:
          'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
      </script>
      @endif
      <textarea
      name="body"
      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
      rows="50"
      >{{ $ad->body ?? old('body') }}</textarea>

      <p class="text-white font-semibold">URL</p>
      <x-input
      name="url"
      placeholder="Your URL Here"
      value="{{ $ad->url ?? old('url') ?? '' }}"
      />

      <input type="hidden" name="id" value="{{ $ad->id ?? '' }}" />
    </div>
  </form>

  <!-- Buttons side-by-side -->
  <div class="mt-6 flex items-center space-x-4">
    <!-- Submit -->
    <form method="POST" action="/ads/create" class="flex-shrink-0">
      @csrf
      <input type="hidden" name="id" value="{{ $ad->id ?? '' }}" />
      <button
      type="submit"
      form="ad-data-form"
      class="px-5 py-2 bg-[#04cef6] hover:bg-[#039ac0] text-white rounded font-medium transition"
      >
      Submit Your Ad
    </button>
  </form>

  <!-- Delete -->
  <form method="POST" action="/ads/delete" class="flex-shrink-0">
    @csrf
    <input type="hidden" name="id" value="{{ $ad->id ?? '' }}" />
    <button
    type="submit"
    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-medium transition"
    >
    Delete Ad
  </button>
</form>
</div>

</div>
</div>


@else



<!-- Two Fighter Cards (VS page style) -->
<div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
  <!-- Fighter Card 1 -->
  <div
  class="flex flex-col items-start gap-6 rounded-lg bg-white text-black p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:p-10 lg:pb-10"
  style="cursor: pointer;"
  onclick=""
  >
  <div class="flex items-start gap-6">
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
<div class="flex items-start gap-6">
  <img
  src="{{ isset($opponentsAd) ? $opponentsAd->user->profile_photo_url : '/annonymous.png' }}"
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
@endif
</x-app-layout>
