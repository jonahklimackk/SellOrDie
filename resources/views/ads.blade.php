

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-[#F7F7F7] dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-[#F7F7F7] ">

                    <?PHP
// dump($ad->random_opponent);
// dump(Auth::user()->currentTeam->status);
                    ?>
                    @if((isset($ad) && isset($opponentsAd) || (isset($ad->random_opponent) && $ad->random_opponent)) && Auth::user()->currentTeam->status != 'live')
                    <div class=" float-right">
                        <form action="/fight/start/" method="POST">
                           <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? ''}}">
                           @csrf
                           <x-red-button>
                            Start Fight
                        </x-red-button>
                    </form> 
                </div>
                @elseif(Auth::user()->currentTeam->status == 'live')
                <div class=" float-right">
                    <form action="/fight/stop/" method="POST">
                       <input type="hidden" name="fight_id" value="{{ Auth::user()->currentTeam->id ?? ''}}">
                       @csrf
                       <x-red-button>
                        Fight is Live!
                    </x-red-button>
                </form> 
            </div>               

            @else
            <div class=" float-right">
                <x-red-button disabled>
                    Start Fight
                </x-red-button>
            </div>
            @endif


            <div class="flex gap-5">
             <img src="/img/boxingglove.png" width="100" height="100"> 
             <h1 class="mt-2  text-4xl font-medium text-gray-900 ">
               Welcome To  {{ Auth::user()->currentTeam->name }}
           </h1>
       </div>

       <div class="flex flex-wrap float-right justify-between">   

        <div class="bg-gray-800 shadow-2xl rounded-xl p-6 text-sm font-medium text-gray-100 space-y-4 max-w-3xl mx-auto mt-4">
          <div class="grid grid-cols-3 gap-2">
            <div>Fights:</div><div></div><div>{{ App\Models\FightViewLog::getViews($fight->id, 'all') ?? 0 }}</div>

            @if(isset($opponentsAd))
            <div>{{ $opponentsAd->user->name ?? '' }}'s Clicks:</div><div></div><div>{{ $opponentsClicks ?? 0 }}</div>
            @else
            <div>Opponent's Clicks:</div><div></div><div>{{ $opponentsClicks ?? 0 }}</div>
            @endif

            <div>Your Clicks:</div><div></div><div>{{ $clicks ?? 0 }}</div>

            <div>Your Record:</div><div></div>
            <div>{{ $clicks ?? 0 }} - {{ $opponentsClicks ?? 0 }} - {{ $draws ?? 0 }}</div>

            <div>Win Percentage:</div><div></div><div>{{ $winLoss ?? 0 }}%</div>

            @if (Auth::user()->currentTeam->status == 'live')
            <div>Daily Ranking:</div><div></div><div>{{ $ranking ?? 'n/a' }} place</div>
            @else
            <div>Daily Ranking:</div><div></div><div>n/a</div>
            @endif

            <div>Status:</div><div></div><div>{{ Auth::user()->currentTeam->status }}</div>
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
<div>
   <p class="py-4  text-gray-500  leading-relaxed">
    If you’re serious about becoming the ultimate Fighter in the Sell or Die arena, you need a weapon that delivers a knockout every time. Your ad-weapon should land that perfect 1-2 punch to blow past the competition!

    In Sell or Die, a “Fight” is simply how many times your weapon’s been unleashed—either counted as views or as activations when you wield it. Each Fight pits two fighters and their chosen weapons head-to-head. Challenge an opponent, and once they accept, you’ll get a custom URL to showcase your matchup. As fellow fighters surf and earn credits, they’ll see your battle live in the leaderboard.

    Ready to prove you’ve got the fiercest ad-weapon in the ring? Gear up, lock in your Fight URL, and let the best ad win!
<BR>
  @if (Auth::user()->status === 'heavyweight')
    <a href="#"
       class=" bg-[#04cef6] hover:bg-[#039ac0] text-white font-semibold px-4 py-2 rounded transition">
      Use AI to create the ad for you.
    </a>
  @else
    <a href="#"
       class=" bg-[#04cef6] hover:bg-[#039ac0] text-white font-semibold px-4 py-2 rounded transition">
      Upgrade to Heavyweight – All you have to do is paste in your url and it'll know how to genereate a beautiful fighter card for you
    </a>
  @endif
</div> 
</p>


<div class="mb-6"><font color="red"><b>{{ session('red_message') ?? ''}}</b></font></div>
<div class="mb-6"><font color="green"><b>{{ session('green_message') ?? ''}}</b></font></div>


@if(!is_null($ad) && !isset($edit))
<div class="mt-6 px-10">
    <form action="/ads/edit" method="GET">
        <x-button>
            Edit Ad
        </x-button>
    </form>
</div>
@endif

@if(!is_null($ad) && !isset($edit))
<div class="flex justify-around pt-4">
    <div class="text-2xl"> Your Ad Weapon </div>
    @if (isset($opponentsAd))
    <div class="text-2xl"> {{ $opponentsAd->user->name ?? ''}}'s Ad Weapon </div>
    @elseif($ad->random_opponent)
    <div></div>
    <div>
        <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
            <x-button>
                Invite Opponent 
            </x-button>
        </form>
    </div>               
    @else
    <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
        <x-button>
            Invite Opponent 
        </x-button>
    </form>
    <form action="/ads/random-opponent/" method="POST">
       <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
       @csrf
       <x-button>
        Random Opponent 
    </x-button>
</form>                            

@endif
</div>                    
@endif


@if(is_null($ad) || isset($edit))
<div class="mt-6 mb-6">
    <ul>
        @foreach($errors->all() as $error)
        <li><font color="red">{{ $error }}</font></li>
        @endforeach
    </ul>                      
</div>




<form method="POST" action="/ads/create">
  @csrf
  <div class="grid grid-cols-1 gap-6 space-between">
      <x-label> Headline</x-label>
      <x-input name="headline" placeholder="Your Headline Here" value="{{ $ad->headline ?? old('headline') ?? ''}}"/>
        <x-label> Category </x-label>

        <select name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option>Select Category</option>
            @foreach ($categories as $category)
            @if (!is_null($ad) && $ad->category == $category->category)
            <option selected> {{ $category->category }} </option>
            @else
            <option> {{ $category->category }} </option>
            @endif
            @endforeach
        </select>

        <!-- <textarea name="body" rows="12" cols="65" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $ad->body ?? old('body' ?? '')}}</textarea> -->



<!--         <div class="main-container">
            <div
                class="editor-container editor-container_classic-editor editor-container_include-block-toolbar editor-container_include-word-count"
                id="editor-container"
            >
                <div class="editor-container__editor"><div id="editor"></div></div>
                <div class="editor_container__word-count" id="editor-word-count"></div>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.umd.js" crossorigin></script>
        <script src="./main.js"></script> -->

<!-- <textarea id="body" name="body" rows="12" cols="65" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"> 
  {{ $ad->body ?? old('body' ?? '')}}
</textarea>

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
        <script> 
            var editor = new FroalaEditor('#body');
        </script>
    -->

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        @if (Auth::user()->status !='free')              

        <script>
          tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    @endif
    <textarea name="body">
        {{ $ad->body ?? old('body' ?? '')}}
    </textarea>
    





    <x-label /> Url
    <x-input name="url"  placeholder="Your Url Here" value=" {{ $ad->url ?? old('url') ?? ''}}"/>

        <div class="flex items-start">
            <x-button class="mr-10">
             Submit Your Ad
         </x-button>
         <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
     </form>
     <form method="POST" action="/ads/delete">
      @csrf
      <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
      <x-button>
       Delete Ad
   </x-button>
</div>
</form>


</div>
</div>


@else

<div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
  <main class="mt-10">
    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

        <a
        href="/fights/click/{{ $ad->url ?? ''}}" target="_blank"
        id="docs-card"
        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10"
        >


        @if(str_word_count($ad->headline,0) == 1)
        <div class="relative flex items-center gap-6 lg:items-center">
            @else
            <div class="relative flex-1 items-center gap-6 lg:items-center">
                @endif
                <div class="mt-2 float-left" >
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full size-20 object-cover">
                </div>
                <div class="mt-2">
                    <h1 class="text-5xl font-semibold text-black">
                        {{ $ad->headline ?? ''}}
                    </h1>
                </div>
            </div>
            <div class="mt-2">
                {!! nl2br($ad->body) ?? '' !!}
            </div>


        </a>   
        @if(isset($opponentsAd))
        <a
        href="/fights/click/{{ $opponentsAd->url ?? ''}}" target="_blank"
        id="docs-card"
        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 "
        >


        <div class="relative flex items-center gap-6 lg:items-center">
            <div class="mt-2 float-left" x-show="! photoPreview">
                <img src="{{ $opponentsAd->user->profile_photo_url ?? ''}}" alt="{{ $opponentsAd->user->name ?? '' }}" class="  ">
            </div>
            <div class="mt-2">
                <h1 class="text-5xl font-semibold text-black ">
                    {{ $opponentsAd->headline ?? ''}}
                </h1>
            </div>
        </div>
        <div class="mt-2">
            {!! nl2br($opponentsAd->body) ?? '' !!}
        </div>
    </a>      
</div>
</main>
@elseif($ad->random_opponent)
<a
href="/fights/click/{{ $opponentsAd->url ?? ''}}" target="_blank"
id="docs-card"
class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10"
>


<div class="relative flex items-center gap-6 lg:items-center">
    <div class="mt-2" x-show="! photoPreview">
        <img src="/annonymous.png" class="rounded-full size-20 object-cover">
    </div>
    <div class="mt-2">
        <h1 class="text-5xl font-semibold text-black">
            Random Opponent
        </h1>
    </div>
</div>
<div class="mt-2">

</div>
</a>      
</div>
</main>
@endif           
</div>

@endif
</div>
</div>
</div>
</x-app-layout>



