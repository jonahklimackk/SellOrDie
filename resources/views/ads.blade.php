<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <div class=" float-right">
                        <x-button>
                            Start Fight
                        </x-button>
                    </div>

                    <h1 class="mt-2  text-2xl font-medium text-gray-900 dark:text-white">
                        Welcome To  {{ Auth::user()->currentTeam->name }} 
                    </h1>

                    
                    <div class="flex flex-wrap float-right justify-between">   

                        <div class="mt-2 px-4 py-4 grid lg:grid-cols-3 items- bg-indigo-400 rounded-md font-semibold">
                         <!-- <div> Record: </div> <div> 135 Wins, 78 Lossses </div> -->
                         <!-- <div >Busy Bee Fight</div> <div></div> -->
                         <div> Fights: </div> <div></div><div> {{ Auth::user()->currentTeam->views ?? 0}}</div>
                         @if(isset($opponentsAd))
                         <div> {{ $opponentsAd->user->name ?? '' }}'s Clicks:</div> 
                         <div></div><div> {{ $opponentsAd->clicks ?? 0}}</div>
                         @else
                         <div>Opponent's Clicks:</div> <div></div><div>{{ $randomOpponents->clicks ?? 0 }}</div>
                         @endif
                         <div> Your Clicks: </div><div></div> <div> {{ $ad->clicks ?? 0}}</div> 
                         <div> Your Win %: </div> <div></div><div> n/a </div>
                         <div>Ranking </div> <div></div><div> n/a</div>

                     </div>   
                 </div>
                 <div>
                     <p class="py-4  text-gray-500 dark:text-gray-400 leading-relaxed">
                        If you want to make your name as the best Fighter in the sellordie league, you gotta
                        have a good weapon. Be sure that it packs the 1-2 punch to destroy your opponents!
                        Views is how many times your ad weapon has been viewed. Or, how many times you used this particular weapon. Fights are the number of fights you've been. A fight consits of 2 fighters and 2 weapons.  When you invite someeone to your fight and they acept, you'll have an url to doisplay ypir fogjt amd ot willl be shown to other fithers as trhey earn credits and surfing to surf
                    </p> 
                </div>   










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
                    <div> Your Ad Weapon </div>
                    @if (isset($opponentsAd))
                    <div> {{ $opponentsAd->user->name ?? ''}}'s Ad Weapon </div>
                    @else

                        <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
                            <x-button>
                                Invite Opponent 
                            </x-button>
                        </form>
                        <form action="/teams/{{ Auth::user()->currentTeam->id}}" action="get">
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

                <div>{{ $message ?? ''}}</div>

                <form method="POST" action="/ads/create">
                  @csrf
                  <div class="grid grid-cols-1 gap-6 space-between">
                      <x-label> Headline</x-label>
                      <x-input name="headline" placeholder="Your Headline Here" value="{{ $ad->headline ?? old('headline') ?? ''}}"/>
                        <x-label> Category </x-label>

                        <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            @if (!is_null($ad) && $ad->category == $category->category)
                            <option selected> {{ $category->category }} </option>
                            @else
                            <option> {{ $category->category }} </option>
                            @endif
                            @endforeach
                        </select>

                        <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $ad->body ?? old('body' ?? '')}}</textarea>

                        <x-label /> Url
                        <x-input name="url"  placeholder="Your Url Here" value=" {{ $ad->url ?? ''}}"/>

                          <x-button>
                           Submit Your Ad
                       </x-button>

                       <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
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
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >


                    <div class="relative flex items-center gap-6 lg:items-center">
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full size-20 object-cover">
                        </div>
                        <div class="mt-2">
                            <h1 class="text-xl font-semibold text-black dark:text-white">
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
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >


                <div class="relative flex items-center gap-6 lg:items-center">
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $opponentsAd->user->profile_photo_url ?? ''}}" alt="{{ $opponentsAd->user->name ?? '' }}" class="rounded-full size-20 object-cover">
                    </div>
                    <div class="mt-2">
                        <h1 class="text-xl font-semibold text-black dark:text-white">
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
    @endif           
</div>

@endif
</div>
</div>
</div>
</x-app-layout>



