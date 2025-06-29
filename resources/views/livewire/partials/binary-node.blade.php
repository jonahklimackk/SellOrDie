<div class="binary-node">
    <div class="binary-node__content">
        <div class="font-semibold">{{ $node['name'] }}</div>
        <div class="text-sm text-gray-400">{{ $node['email'] }}</div>
    </div>
    @if($node['left'] || $node['right'])
        <div class="binary-node__children w-full">
            @if($node['left'])
                @include('livewire.partials.binary-node', ['node' => $node['left']])
            @else
                <div class="binary-node__content opacity-25">(empty)</div>
            @endif

            @if($node['right'])
                @include('livewire.partials.binary-node', ['node' => $node['right']])
            @else
                <div class="binary-node__content opacity-25">(empty)</div>
            @endif
        </div>
    @endif
</div>