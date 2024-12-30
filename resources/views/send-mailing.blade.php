<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h1> Send A Mailing </h1>
                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                      <main class="mt-10">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8"> 
                            <a
                            href="{{ $ad->url ?? ''}}" target="_blank"
                            id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div class="mt-2" x-show="! photoPreview">
                                    <img src="{{ $ad->user->profile_photo_url }}" alt="{{ $ad->user->name }}" class="rounded-full size-20 object-cover">
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
                     <a
                     href="{{ $ad->url ?? ''}}" target="_blank"
                     id="docs-card"
                     class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                     >
                     <div class="relative flex items-center gap-6 lg:items-end">
                        <div class="mt-2">
                            <h1 class="text-xl font-semibold text-black dark:text-white">
                                Mailing Statistics
                            </h1>
                        </div> 
                    </div>
                    <div class="mt-2 px-4 py-4  grid lg:grid-cols-2 bg-indigo-200 rounded-md font-semibold">
                        <div> Mailings: </div> <div>4</div>

                     <div> Record: </div> <div> 135 Wins, 78 Lossses </div>
                     <div> Views: </div> <div> 598 </div>
                     <div> Fights: </div> <div> 458</div>
                     <div> Clicks:</div> <div> 231</div>        

                     <div>Standing </div> <div> 38th in league</div>
                     <div> Win %: </div> <div> 54% </div>
                 </div>  
                 <div class="flex gap-6">
                     <x-button class="center">
                        Send Ad
                    </x-button>
                    <form action="ads/edit" method="GET">
                     <x-button class="center">
                        Edit Ad
                    </x-button>  
                </form>                             
            </div>
        </a>                       
    </div>


</main>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>


