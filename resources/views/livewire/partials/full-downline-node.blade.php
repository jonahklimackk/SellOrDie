<li>
    <div class="node-content">
        <div class="font-medium">{{ $branch['user']->name }}</div>
        <div class="text-xs text-gray-300">{{ $branch['user']->email }}</div>
    </div>

    @if(count($branch['children']))
        <ul>
            @foreach($branch['children'] as $child)
                @include('livewire.partials.full-downline-node', ['branch' => $child])
            @endforeach
        </ul>
    @endif
</li>
