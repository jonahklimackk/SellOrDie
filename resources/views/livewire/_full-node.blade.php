<div class="binary-node__content">
  <div class="font-semibold">{{ $node->name }}</div>
  <div class="text-sm text-gray-400">{{ $node->email }}</div>
</div>

@if(count($node->children))
  <ul class="binary-node__children">
    @foreach($node->children as $child)
      <li class="binary-node {{ $child->isPersonal ? 'personal' : '' }}">
        @include('livewire._full-node', ['node' => $child])
      </li>
    @endforeach
  </ul>
@endif
