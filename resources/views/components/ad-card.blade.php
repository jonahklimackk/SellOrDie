@props([
    'headline' => 'Untitled Headline',
    'description' => '',
    'profileImage' => '/annonymous.png',
    'username' => 'Anonymous',
    'offerImage' => '',
    'link' => '#',
    'highlight' => false
])

<a href="{{ $link }}" target="_blank"
   class="flex flex-col gap-6 rounded-xl transition hover:shadow-2xl
   {{ $highlight ? 'bg-gradient-to-br from-yellow-50 via-white to-red-50 ring-[#FF2D20]' : 'bg-white ring-gray-200' }}
   shadow-xl p-8 ring-1">

    {{-- Profile --}}
    <div class="flex items-center gap-4">
        <img src="{{ $profileImage }}" alt="{{ $username }}" class="rounded-full w-16 h-16 object-cover ring-2 {{ $highlight ? 'ring-[#FF2D20]' : 'ring-gray-300' }}">
        <div>
            <h2 class="text-xl font-bold text-gray-800">{{ $username }}</h2>
            <p class="text-sm text-gray-500">{{ $highlight ? '🔥 Featured Challenger' : 'Challenger' }}</p>
        </div>
    </div>

    {{-- Headline --}}
    <h1 class="text-2xl font-extrabold {{ $highlight ? 'text-[#FF2D20]' : 'text-gray-800' }} leading-snug">
        {{ $headline }}
    </h1>

    {{-- Ad Image and Description --}}
    <div class="flex flex-col md:flex-row gap-4 items-center">
        @if($offerImage)
            <img src="{{ $offerImage }}" alt="Offer" class="w-48 h-auto rounded-lg shadow-md border border-gray-300">
        @endif
        @if($description)
            <p class="text-gray-700 text-base font-medium leading-relaxed">
                {{ $description }}
            </p>
        @endif
    </div>

    {{-- CTA --}}
    <div class="mt-4 text-center">
        <span class="inline-block px-6 py-2 bg-[#FF2D20] text-white text-sm font-semibold rounded-md hover:bg-red-600 transition">
            View This Ad & Fight Now
        </span>
    </div>
</a>
