<div class="mt-0 flex justify-center">
  <div class="w-full max-w-3xl bg-gray-900 rounded-2xl shadow-2xl p-6">
    {{-- Title --}}
    <h2 class="text-2xl font-bold text-yellow-300 mb-2">
      {{ __('Fight Name') }}
    </h2>
    {{-- Description --}}
    <p class="text-gray-400 mb-6">
      {{ __("The fight's name and owner information.") }}
    </p>

    {{-- Fight Owner --}}
    <div class="bg-gray-800 rounded-xl shadow-md p-4 mb-6">
      <span class="block text-yellow-200 font-medium mb-2">
        {{ __('Fight Owner') }}
      </span>
      <div class="flex items-center gap-4">
        <img
          src="{{ $team->owner->profile_photo_url }}"
          alt="{{ $team->owner->name }}"
          class="w-12 h-12 rounded-full shadow-sm"
        />
        <div>
          <div class="text-yellow-200 font-semibold">
            {{ $team->owner->name }}
          </div>
          <div class="text-gray-400 text-sm">
            {{ $team->owner->email }}
          </div>
        </div>
      </div>
    </div>

    <form wire:submit.prevent="updateTeamName">
      {{-- Fight Name Input --}}
      <div class="mb-6">
        <label for="name" class="block text-yellow-200 font-medium mb-1">
          {{ __('Fight Name') }}
        </label>
        <input
          id="name"
          type="text"
          wire:model="state.name"
          :disabled="! Gate::check('update', $team)"
          class="w-full bg-gray-800 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="name" class="text-red-500 text-sm mt-1" />
      </div>

      {{-- Actions (button right-aligned) --}}
      <div class="flex items-center justify-end space-x-4">
        <x-action-message class="text-yellow-200" on="saved">
          {{ __('Saved.') }}
        </x-action-message>
        <button
          type="submit"
          class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
        >
          {{ __('Save') }}
        </button>
      </div>
    </form>
  </div>
</div>
