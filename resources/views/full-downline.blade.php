{{-- resources/views/full-downline.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">My Full Downline</h2>
  </x-slot>

  <div class="container mx-auto py-8">
    <ul class="binary-tree flex justify-center">
      {{-- start at the root; highlight flag = false --}}
      @foreach($tree as $rootNode)
        @include('partials.full-downline', [
          'node'      => $rootNode,
          'highlight' => false,   {{-- root itself is never highlighted --}}
          'isRoot'    => true,    {{-- mark this first call as “at root” --}}
        ])
      @endforeach
    </ul>
  </div>
</x-app-layout>
