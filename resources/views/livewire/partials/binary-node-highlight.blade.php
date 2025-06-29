<li class="binary-node {{ $node->isPersonal ? 'personal' : '' }}">
  <div class="binary-node__content">
    <div class="font-semibold">{{ $node->name }}</div>
    <div class="text-sm text-gray-400">{{ $node->email }}</div>
  </div>

  @if(count($node->children))
    <ul class="binary-node__children">
      @foreach($node->children as $child)
        @include('livewire.partials.binary-node-highlight', ['node' => $child])
      @endforeach
    </ul>
  @endif
</li>