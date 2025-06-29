{{-- resources/views/livewire/partials/full-downline-card.blade.php --}}
@php
    // Ensure $depth is always an integer
    $depth = isset($depth) ? (int)$depth : 1;

    // Only show kids if there *are* children and we haven't hit level 7 yet
    $showKids = !empty($branch['children']) && $depth < 7;
@endphp

<div class="downline-card">
    <div class="font-semibold text-lg">{{ $branch['user']->name }}</div>
    <div class="text-sm text-gray-600">{{ $branch['user']->email }}</div>
</div>

@if($showKids)
    <div class="downline-children">
        @foreach($branch['children'] as $child)
            @include('livewire.partials.full-downline-card', [
              'branch' => $child,
              'depth'  => $depth + 1,
            ])
        @endforeach
    </div>
@endif
