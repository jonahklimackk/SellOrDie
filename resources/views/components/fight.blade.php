                   <div align="center">
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
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full size-20 object-cover">
                                    </div>

                                    <div class="mt-2">
                                        <h1 class="text-xl font-semibold text-black dark:text-white">
                                            {{ $ad->headline ?? ''}}
                                        </h1>

                                    </div>





                                </div>

                                <div class="mt-2">
                                 {{ $ad->body ?? ''}}

                             </div>
                         </a>
                     </div>
