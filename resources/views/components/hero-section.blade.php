@props([
    'title',       // e.g. "Ad Weapon"
    'tiers',       // associative array: ['Amateur' => 'Text only', …]
    'benefit',     // the benefit string
])

<section id="{{ Str::slug($title) }}" class="bg-[#1f1c27] text-white py-16">
  <div class="max-w-7xl mx-auto px-6">
    {{-- Title --}}
    <h2 class="text-4xl font-bold text-yellow-300 mb-6">{{ $title }}</h2>

    {{-- Tier Values --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
      @foreach($tiers as $tierName => $tierValue)
        <div class="bg-gray-900 p-6 rounded-2xl shadow-lg">
          <h3 class="text-2xl font-semibold text-yellow-300 mb-2">{{ $tierName }}</h3>
          <p class="text-lg">{{ $tierValue }}</p>
        </div>
      @endforeach
    </div>

    {{-- Benefit --}}
    <p class="text-xl leading-relaxed">{{ $benefit }}</p>
  </div>
</section>
