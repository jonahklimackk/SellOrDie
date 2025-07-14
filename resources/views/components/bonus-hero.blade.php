@props([
  'title',        // string
  'description',  // string
  'iconSrc',      // URL to a small SVG/PNG icon
  'imageSrc',     // URL to a larger hero image
  'trueValue'     // optional numeric/string value for “True Value”
])

<section class="bg-[#1f1c27] text-white py-16">
  <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center gap-8">
    {{-- Icon --}}
    <div class="flex-shrink-0">
      <img src="{{ $iconSrc }}"
           alt="{{ $title }} Icon"
           class="h-12 w-12"/>
    </div>

    {{-- Text --}}
    <div class="flex-1">
      <h3 class="text-3xl font-bold text-yellow-300 mb-2">{{ $title }}</h3>
      <p class="text-lg">{{ $description }}</p>

      {{-- True Value --}}
      @if(!empty($trueValue))
        <p class="text-2xl text-red-500 font-semibold mt-2">
          True Value: ${{ $trueValue }}
        </p>
      @endif
    </div>

    {{-- Hero Image --}}
    <div class="flex-shrink-0">
      <img src="{{ $imageSrc }}"
           alt="{{ $title }}"
           class="rounded-2xl shadow-lg w-full max-w-sm"/>
    </div>
  </div>
</section>
