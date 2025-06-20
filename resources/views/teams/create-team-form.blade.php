<div class="mt-0 flex justify-center">
  <div class="relative w-full max-w-3xl">
    {{-- Outer “shadow” card behind --}}
    <div class="absolute inset-0 bg-gray-800 rounded-2xl shadow-2xl transform scale-95"></div>

    {{-- Main card --}}
    <div class="relative bg-gray-900 rounded-2xl shadow-2xl p-6">
      <h2 class="text-2xl font-bold text-yellow-300 mb-2">
        {{ __('Fight Details') }}
      </h2>
      <p class="text-gray-400 mb-6">
        {{ __('Create a new fight so you can see who is the better salesperson.') }}
      </p>

      <form wire:submit.prevent="createTeam" class="space-y-6">
        {{-- Fight Owner --}}
        <div class="bg-gray-800 rounded-xl shadow-md p-4">
          <span class="block text-yellow-200 font-medium">
            {{ __('Fight Owner') }}
          </span>
          <div class="flex items-center mt-2">
            <img
              src="{{ $this->user->profile_photo_url }}"
              alt="{{ $this->user->name }}"
              class="w-12 h-12 rounded-full shadow-sm"
            />
            <div class="ml-4 leading-tight">
              <div class="text-yellow-200 font-semibold">
                {{ $this->user->name }}
              </div>
              <div class="text-gray-400 text-sm">
                {{ $this->user->email }}
              </div>
            </div>
          </div>
        </div>

        {{-- Fight Name --}}
        <div class="bg-gray-800 rounded-xl shadow-md p-4">
          <label for="name" class="block text-yellow-200 font-medium mb-1">
            {{ __('Fight Name') }}
          </label>
          <input
            id="name"
            type="text"
            wire:model="state.name"
            autofocus
            class="mt-1 block w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
          />
          <x-input-error for="name" class="text-red-500 text-sm mt-1" />
        </div>

        {{-- Submit (left-aligned) --}}
        <div class="flex justify-start">
          <button
            type="submit"
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-6 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
          >
            {{ __('Create') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
