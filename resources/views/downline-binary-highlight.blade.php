<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('My Binary Downline') }}
    </h2>
  </x-slot>

  {{-- here we only drop in the Livewire component --}}
  <livewire:downline-binary-highlight />
</x-app-layout>
