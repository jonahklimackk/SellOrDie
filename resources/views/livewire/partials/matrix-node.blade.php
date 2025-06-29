<li>
    <div class="matrix-node__box">
        <div class="font-semibold">{{ $node['name'] }}</div>
        <div class="text-sm text-gray-400">{{ $node['email'] }}</div>
    </div>

    {{-- Filter out empty children so we don’t pass null to the partial --}}
    @php
        $validChildren = array_filter($node['children']);
    @endphp

    @if(count($validChildren))
        <ul class="matrix-children">
            @foreach($validChildren as $child)
                @include('livewire.partials.matrix-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>