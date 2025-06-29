<div>
    @if(! $nodes)
        <p class="text-gray-400 p-4">No downline positions yet.</p>
    @else
        <ul class="matrix-tree">
            @include('livewire.partials.matrix-node', ['node' => $nodes])
        </ul>
    @endif

    <style>
    .matrix-tree, .matrix-tree ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .matrix-tree li {
        margin: 1rem;
        display: inline-block;
        vertical-align: top;
    }
    .matrix-node__box {
        background-color: #1F2937;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-align: center;
        min-width: 8rem;
        margin-bottom: 0.5rem;
    }
    /* you can add lines/connectors here if you like */
    </style>
</div>