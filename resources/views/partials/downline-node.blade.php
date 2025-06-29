<li class="binary-node {{ $depth === 1 ? 'personal' : '' }}">
  <div class="binary-node__content">
    <div class="font-semibold">{{ $node['name'] }}</div>
    <div class="text-sm text-gray-400">{{ $node['email'] }}</div>
  </div>

  @if(count($node['children'] ?? []))
    <ul class="binary-node__children">
      @foreach($node['children'] as $child)
        @include('partials.downline-node', [
          'node'  => $child,
          'depth' => $depth + 1,
        ])
      @endforeach
    </ul>
  @endif
</li>
