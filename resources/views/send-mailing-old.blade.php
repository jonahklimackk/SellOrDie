<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">


                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class=" text-2xl font-medium text-gray-900 dark:text-white">
                            Send A Mailing </h1>
                        </div>

                        <div >
                            <select namse="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">                               
                                <option> Show All Mailing Stats</option>
                                @foreach ($mailings as $mailing)
                                <!-- <option selected> {{ $mailing->subject }} </option> -->
                                <option> {{ $mailing->subject }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                      <main class="mt-10">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8"> 
                            <a
                            href="{{ $ad->url ?? ''}}" target="_blank"
                            id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                            <div class="relative flex items-start gap-6 lg:items-end">
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
                     <div
                     class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                     >
                     <div class="relative flex items-center gap-6 lg:items-end">
                        <div class="mt-2">
                            <h1 class="text-xl font-semibold text-black dark:text-white">
                                Mailing Privileges
                            </h1>
                        </div> 
                    </div>
                    <div class="mt-2 px-4 py-4  grid lg:grid-cols-2 bg-indigo-200 rounded-md font-semibold">
                        <div> Last Mailing</div> <div>no previous mailings</div>
                        <div> Mailing Status: </div> <div> You can send a mailing now!</div>
                        <div> Mailing Bonus: </div> <div> Your ad reaches 0 on this mailing </div>
                        <div> Max Recipients </div> <div> 1500</div>
                        <div> Mailing Frequency</div> <div> every 5 days</div> 
                    </div>  

                    <div class="mt-2">
                        <h1 class="text-xl font-semibold text-black dark:text-white">
                            Number Of Recipients
                        </h1>                        
                    </div> 

                    <div> Enter Credits </div>
                    <div><form>
                        <x-input /></form>
                    </div>  

                    <div class="mt-2 px-4 py-4  grid lg:grid-cols-2 bg-indigo-200 rounded-md font-semibold">
                        <div> Number of People In Downline</div> <div> 0 </div>
                        <div> Bonus Recipients From Upgrade</div> <div> 0</div>
                        <div> Credits Spent </div> <div>300 </div>
                        <div> Total Recipients </div> <div> 300</div>
                        <!-- <div> Your message will reach</div> <div> 300 recipients</div>  -->
                    </div>  


                    <div class="flex flex-row justify-between">
                        <div>
                         <x-green-button class="">
                            Send Ad
                        </x-green-button>
                    </div>
                    <div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
                    <div>
                        <form action="ads/edit" method="GET">
                         <x-button class="x-6" >
                            Edit Ad
                        </x-button> 
                    </form>     
                </div>
                <div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
                <div>
                    <form action="ads/edit" method="GET">
                     <x-button class="x-6" >
                        New Ad
                    </x-button> 
                </form>     
            </div>


        </div>
    </div>                       
</div>

</main>
</div>
</div>
</div>
</div>
</div>
</x-app-layout>





