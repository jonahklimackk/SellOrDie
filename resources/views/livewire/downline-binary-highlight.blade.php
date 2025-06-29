    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Binary Downline') }}
        </h2>
    </x-slot>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($tree)
          <ul class="binary-tree flex justify-center">
            @include('livewire.partials.binary-node-highlight', ['node' => $tree])
          </ul>
        @else
          <p class="text-center text-gray-500">No downline data available.</p>
        @endif
      </div>
    </div>

    @push('styles')
    <style>
      .binary-tree, .binary-tree ul { list-style: none; margin: 0; padding: 0; }
      .binary-tree > li { margin: 1rem; }

      .binary-node {
          display: flex;
          flex-direction: column;
          align-items: center;
      }
      .binary-node__content {
          background: #1F2937;
          color: #fff;
          padding: 0.5rem 1rem;
          border-radius: 0.5rem;
          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
          text-align: center;
          min-width: 8rem;
          position: relative;
      }
      .binary-node.personal > .binary-node__content {
          border: 2px solid #FBBF24;
      }
      .binary-node__children {
          display: flex;
          justify-content: center;
          gap: 2rem;
          margin-top: 1rem;
          position: relative;
      }
      .binary-node__children::before {
          content: '';
          position: absolute;
          top: 0; left: 50%;
          height: 1rem;
          border-left: 2px solid #4B5563;
      }
      .binary-node__children > li:first-child::before {
          content: '';
          position: absolute;
          top: 0; right: 50%;
          width: 50%;
          border-top: 2px solid #4B5563;
      }
      .binary-node__children > li:last-child::before {
          content: '';
          position: absolute;
          top: 0; left: 50%;
          width: 50%;
          border-top: 2px solid #4B5563;
      }
    </style>
    @endpush

