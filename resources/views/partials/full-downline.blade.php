{{-- resources/views/partials/full-downline.blade.php --}}
@php
  // this node gets the “personal” class if highlight===true
  $classes = $highlight ? 'binary-node personal' : 'binary-node';
@endphp

<li class="{{ $classes }}">
  <div class="binary-node__content">
    <div class="font-semibold">{{ $node['name'] }}</div>
    <div class="text-sm text-gray-400">{{ $node['email'] }}</div>
  </div>

  @if(! empty($node['children']))
    <ul class="binary-node__children">
      @foreach($node['children'] as $child)
        @include('partials.full-downline', [
          'node'      => $child,
          // only highlight *this* child if its parent was the root
          'highlight' => $isRoot,
          // after the first level, we’re no longer “at” the root
          'isRoot'    => false,
        ])
      @endforeach
    </ul>
  @endif
</li>
