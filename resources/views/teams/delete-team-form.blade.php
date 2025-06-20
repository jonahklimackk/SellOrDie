<div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
  {{-- Title --}}
  <h2 class="text-2xl font-bold text-yellow-300 mb-2">
    {{ __('Delete Fight') }}
  </h2>
  {{-- Description --}}
  <p class="text-gray-400 mb-6">
    {{ __('Permanently delete this fight.') }}
  </p>

  {{-- Warning Text --}}
  <div class="max-w-xl text-sm text-gray-500 mb-6">
    {{ __('Once a fight is deleted, all of its resources and data will be permanently deleted. Before deleting this fight, please download any data or information regarding this fight that you wish to retain.') }}
  </div>

  {{-- Delete Button (right-aligned) --}}
  <div class="flex justify-end">
    <button
      wire:click="$toggle('confirmingTeamDeletion')"
      wire:loading.attr="disabled"
      class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition"
    >
      {{ __('Delete Fight') }}
    </button>
  </div>

  {{-- Confirmation Modal --}}
  <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
    <x-slot name="title">
      <h3 class="text-xl font-bold text-yellow-300">
        {{ __('Delete Fight') }}
      </h3>
    </x-slot>

    @if(Auth::user()->allTeams()->count() > 1)
      <x-slot name="content">
        <p class="text-gray-200">
          {{ __('Are you sure you want to delete this fight? Once a fight is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
      </x-slot>
      <x-slot name="footer">
        <button
          wire:click="$toggle('confirmingTeamDeletion')"
          class="bg-gray-800 text-yellow-200 hover:bg-gray-700 font-medium px-4 py-2 rounded-lg shadow transition"
        >
          {{ __('Cancel') }}
        </button>
        <button
          wire:click="deleteTeam"
          wire:loading.attr="disabled"
          class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow ml-3 transition"
        >
          {{ __('Delete Fight') }}
        </button>
      </x-slot>
    @else
      <x-slot name="content">
        <p class="text-gray-200">
          {{ __('You must leave at least one fight.') }}
        </p>
      </x-slot>
      <x-slot name="footer">
        <button
          wire:click="$toggle('confirmingTeamDeletion')"
          class="bg-gray-800 text-yellow-200 hover:bg-gray-700 font-medium px-4 py-2 rounded-lg shadow transition"
        >
          {{ __('Cancel') }}
        </button>
      </x-slot>
    @endif
  </x-confirmation-modal>
</div>
