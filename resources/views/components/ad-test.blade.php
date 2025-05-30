
        <a
        href="/fights/click/{{ $ad->url ?? ''}}" target="_blank"
        id="docs-card"
        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10"
        >

            <div class="relative flex-1 items-center gap-6 lg:items-center">
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