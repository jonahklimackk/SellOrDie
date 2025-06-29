{{-- resources/views/partials/downline-node.blade.php --}}
@php
  // only highlight at depth 1 *and* if it's marked personal
  $highlight = ($depth === 1 && data_get($node, 'isPersonal'));
@endphp

<li class="binary-node {{ $highlight ? 'personal' : '' }}">
  <div class="binary-node__content">
    <div class="font-semibold">{{ data_get($node, 'name') }}</div>
    <div class="text-sm text-gray-400">{{ data_get($node, 'email') }}</div>
  </div>

  @if(! empty(data_get($node, 'children')))
    <ul class="binary-node__children">
      @foreach(data_get($node, 'children') as $child)
        @include('partials.downline-node', [
          'node'  => $child,
          'depth' => $depth + 1,
        ])
      @endforeach
    </ul>
  @endif
</li>
