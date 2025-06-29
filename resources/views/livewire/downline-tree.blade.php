<div>
    @if(count($tree) === 0)
        <p class="text-gray-400 p-4">You have no downline positions yet.</p>
    @else
        <div class="p-4 overflow-auto">
            <ul class="tree">
                @foreach($tree as $node)
                    @include('livewire.partials.downline-node', ['node' => $node])
                @endforeach
            </ul>
        </div>
    @endif

    <style>
    .tree, .tree ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .tree li {
        margin-left: 1rem;
        position: relative;
    }
    .tree li::before {
        content: '';
        position: absolute;
        top: 1rem;
        left: -1rem;
        width: 1rem;
        height: 0;
        border-top: 1px solid #4B5563; /* gray-600 */
    }
    .tree li::after {
        content: '';
        position: absolute;
        top: 1rem;
        left: -1rem;
        width: 0;
        height: calc(100% - 1rem);
        border-left: 1px solid #4B5563;
    }
    .tree li:last-child::after {
        display: none;
    }
    </style>
</div>

