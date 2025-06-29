@php
  // Indent per level
  $indent = $level * 1.5; /* rem */
@endphp

<li class="bg-sod-panel border border-sod-yellow rounded-2xl p-4 shadow" 
    style="margin-left: {{ $indent }}rem;">
  <div class="flex justify-between items-center">
    <div>
      <span class="font-semibold text-white">{{ $node['user']->name }}</span>
      <span class="text-gray-500 text-sm">({{ $node['user']->email }})</span>
    </div>
    <div>
      <span class="text-sod-yellow font-bold">
        +${{ number_format($node['credits'],2) }}
      </span>
      <span class="text-gray-400 text-sm">credited</span>
    </div>
  </div>

  @if(! empty($node['children']))
    <ul class="mt-3 space-y-2">
      @foreach($node['children'] as $child)
        @include('partials.matrix-node', ['node' => $child, 'level' => $level + 1])
      @endforeach
    </ul>
  @endif
</li>
