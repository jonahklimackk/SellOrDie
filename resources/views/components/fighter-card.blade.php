@props([
    'title',
    'body',
    'image' => '/img/default.png',
    'fighter' => 'Anonymous Fighter',
    'link' => '#',
])

<div class="flex flex-col h-full bg-white shadow-xl rounded-xl ring-2 ring-transparent hover:ring-yellow-400 transition overflow-hidden">
    <div class="flex items-center gap-4 p-4">
        <img src="{{ $image }}" alt="{{ $fighter }}" class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400 shadow">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">{{ $fighter }}</h2>
        </div>
    </div>

    <div class="px-6 pb-4 flex-grow">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $title }}</h3>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $body }}</p>
    </div>

    <div class="bg-gray-100 px-6 py-3 text-sm text-gray-600 flex justify-between items-center mt-auto">
        <span>Category</span>
        <a href="{{ $link }}" class="text-yellow-500 hover:text-yellow-600 font-semibold">👊 View Fight</a>
    </div>