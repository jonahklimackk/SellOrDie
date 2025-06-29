<div class="overflow-auto p-4 bg-gray-100">
  <ul class="binary-tree flex justify-center">
    <li class="binary-node {{ $tree->isPersonal ? 'personal' : '' }}">
      @include('livewire._full-node', ['node' => $tree])
    </li>
  </ul>
</div>
