@props(['node'])

@php
    // Compute photo URL or fallback to Gravatar
    $photoUrl = $node['photo_path']
        ? \Illuminate\Support\Facades\Storage::url($node['photo_path'])
        : 'https://www.gravatar.com/avatar/'
          . md5(strtolower(trim($node['email'])))
          . '?s=100&d=identicon';
@endphp

<li class="relative flex flex-col items-center">
    {{-- ─── Node Card ─────────────────────────────────────── --}}
    <div class="flex items-center space-x-4 p-4 bg-gray-800 rounded-lg shadow-lg">
        <img src="{{ $photoUrl }}" alt="{{ $node['name'] }}"
             class="h-12 w-12 rounded-full border-2 border-sod-yellow">
        <div>
            <div class="font-semibold text-white">{{ $node['name'] }}</div>
            <div class="text-gray-400 text-sm">{{ $node['email'] }}</div>
        </div>
    </div>

    @if(count($node['children']))
        {{-- ─── Connector Line ──────────────────────────────── --}}
        <div class="h-8 border-l-2 border-gray-700 mt-2"></div>

        {{-- ─── Children Row ────────────────────────────────── --}}
        <div class="flex space-x-8 mt-4">
            @foreach($node['children'] as $child)
                <x-downline-node :node="$child" />
            @endforeach
        </div>
    @endif
</li>
