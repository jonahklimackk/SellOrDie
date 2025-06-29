<div>
    <div class="p-4 overflow-auto">
        @if(! $nodes)
            <p class="text-gray-400">No binary downline available.</p>
        @else
            <div class="flex justify-center">
                @include('livewire.partials.binary-node', ['node' => $nodes])
            </div>
        @endif
    </div>

    <style>
    .binary-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0.5rem;
    }
    .binary-node__content {
        background-color: #1F2937; /* gray-800 */
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
        min-width: 8rem;
    }
    .binary-node__children {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-top: 1rem;
        position: relative;
    }
    /* connector lines */
    .binary-node__children::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 0;
        height: 1rem;
        border-left: 2px solid #4B5563;
    }
    .binary-node__children > .binary-node:first-child::before {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        width: 50%;
        border-top: 2px solid #4B5563;
    }
    .binary-node__children > .binary-node:last-child::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        border-top: 2px solid #4B5563;
    }
    </style>
</div>