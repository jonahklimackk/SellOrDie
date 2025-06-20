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

    <!-- in your <head> somewhere -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <div class="w-full md:w-1/3 relative">
        <form
        id="stats-toggle-form"
        data-live="{{ Auth::user()->currentTeam->status === 'live' ? 'true' : 'false' }}"
        action="{{ url('/fight/start') }}"
        method="POST"
        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
        >
        @csrf
        <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id }}">



        @if(!$ad || ($ad && !$ad->random_opponent && !$opponentsAd))
        <button
        id="stats-toggle-btn"
        type="submit"
        disabled
        class="inline-flex items-center justify-center gap-2
        px-6 py-3 bg-red-600 hover:bg-red-700
        text-white font-bold uppercase tracking-wide
        rounded-full shadow-lg transition duration-200 ease-in-out
        focus:outline-none ring-2 ring-offset-2 ring-yellow-400 group

        disabled:bg-red-400
        disabled:hover:bg-red-400
        disabled:opacity-50
        disabled:cursor-not-allowed
        "
        >
        <span
        id="stats-toggle-icon"
        class="text-xl transform transition-transform duration-300
        group-hover:animate-bounce disabled:group-hover:animate-none"
        >
        🥊
      </span>
      <span id="stats-toggle-label">
        {{ Auth::user()->currentTeam->status === 'live' ? 'Fight Is Live!' : 'Start Fight' }}
      </span>
    </button>        

    @else
    <button
    id="stats-toggle-btn"
    type="submit"
    class="inline-flex items-center justify-center gap-2
    px-6 py-3 bg-red-600 hover:bg-red-700
    text-white font-bold uppercase tracking-wide
    rounded-full shadow-lg transition duration-200 ease-in-out
    focus:outline-none ring-2 ring-offset-2 ring-yellow-400 group"
    >
    <span id="stats-toggle-icon" class="text-xl transform transition-transform duration-300 group-hover:animate-bounce">
      🥊
    </span>
    <span id="stats-toggle-label">
      {{ Auth::user()->currentTeam->status === 'live' ? 'Fight Is Live!' : 'Start Fight' }}
    </span>
  </button>
  @endif


</form>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form        = document.getElementById('stats-toggle-form');
    const btn         = document.getElementById('stats-toggle-btn');
    const icon        = document.getElementById('stats-toggle-icon');
    const label       = document.getElementById('stats-toggle-label');
    const statusLabel = document.getElementById('stats-status');
    const token       = document.querySelector('meta[name="csrf-token"]').content;

  // initialize
    let live = form.dataset.live === 'true';

    form.addEventListener('submit', async e => {
      e.preventDefault();
      btn.disabled = true;
      btn.classList.add('opacity-50','cursor-not-allowed');
    statusLabel.textContent = ''; // clear previous message

    try {
      const res  = await fetch(form.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token },
        body: new FormData(form)
      });
      if (!res.ok) throw new Error(res.statusText);

      const { live: newLive, message } = await res.json();

      // update live flag & data attribute
      live = !!newLive;
      form.dataset.live = live;

      // store message in data-attribute (optional)
      form.dataset.message = message;

      // swap form action URL
      form.action = live
      ? "{{ url('/fight/stop') }}"
      : "{{ url('/fight/start') }}";

      // update button text & icon
      label.textContent = live ? 'Fight Is Live!' : 'Start Fight';
      icon.textContent  = live ? '🔥' : '🥊';

      // show the server message
      statusLabel.textContent = message;

    } catch (err) {
      console.error('AJAX error:', err);
      statusLabel.textContent = 'An error occurred.';
    } finally {
      btn.disabled = false;
      btn.classList.remove('opacity-50','cursor-not-allowed');
    }
  });
  });
</script>


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

    <div class="whitespace-nowrap">Status:</div><div></div><div id="stats-status">{{ Auth::user()->currentTeam->status }}</div>


  </div>

  @if(!(!$opponentsClicks && !$clicks && !Auth::user()->currentTeam->views))
  <div class="text-center pt-4">
    <form action="/fight/reset" method="POST">
      @csrf
      <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? '' }}">
      <x-button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition">
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

<!--   <h2 class="text-2xl font-bold text-yellow-300 mb-4">
  {{ url()->previous() }}
</h2> -->



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



<div class="max-w-7xl mx-auto bg-[#1F2937]  rounded-xl shadow-lg overflow-hidden">
  <div class="px-6 py-4">

    <!-- Ad fields form (hidden submit) -->
    <form method="POST" action="/ads/create" id="ad-data-form">
      @csrf
      <div class="grid grid-cols-1 gap-6">
        <p class="text-yellow-300 font-semibold">Headline</p>
        <x-input
        name="headline"
        placeholder="Your Headline Here"
        value="{{ $ad->headline ?? old('headline') ?? '' }}"
        />

        <p class="text-yellow-300 font-semibold">Select Category</p>
        <div class="relative inline-block w-full max-w-sm">
          <select
          id="category"
          name="category"
          class="
          block w-full bg-gray-800 text-gray-100 border-yellow-100
          rounded-lg shadow-md
          border-transparent
          focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50
          px-4 py-2
          appearance-none
          "
          >
          @foreach($categories as $category)
          <option
          value="{{ $category->category }}"
          class="bg-gray-700 text-gray-100"
          {{ (!is_null($ad) && $ad->category == $category->category) ? 'selected' : '' }}
          >
          {{ $category->category }}
        </option>
        @endforeach
      </select>
      <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
        <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.04 1.08l-4.24 4a.75.75 0 01-1.04 0l-4.24-4a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
        </svg>
      </div>
    </div>


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
    rows="25"
    >{{ $ad->body ?? old('body') }}</textarea>

    <p class="text-yellow-300 font-semibold">URL</p>
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
