<div class="mt-10 flex justify-center">
  <div class="w-full max-w-3xl bg-gray-900 rounded-2xl shadow-2xl p-6">
    {{-- Header --}}
    <h2 class="text-2xl font-bold text-yellow-300 mb-2">
      {{ __('Update Password') }}
    </h2>
    <p class="text-gray-400 mb-6">
      {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form wire:submit.prevent="updatePassword" class="space-y-6">
      {{-- Current Password --}}
      <div class="bg-gray-800 rounded-xl shadow-md p-4">
        <label for="current_password" class="block text-yellow-200 font-semibold mb-1">
          {{ __('Current Password') }}
        </label>
        <input
          id="current_password"
          type="password"
          wire:model="state.current_password"
          autocomplete="current-password"
          class="w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="current_password" class="text-red-500 text-sm mt-1" />
      </div>

      {{-- New Password --}}
      <div class="bg-gray-800 rounded-xl shadow-md p-4">
        <label for="password" class="block text-yellow-200 font-semibold mb-1">
          {{ __('New Password') }}
        </label>
        <input
          id="password"
          type="password"
          wire:model="state.password"
          autocomplete="new-password"
          class="w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="password" class="text-red-500 text-sm mt-1" />
      </div>

      {{-- Confirm Password --}}
      <div class="bg-gray-800 rounded-xl shadow-md p-4">
        <label for="password_confirmation" class="block text-yellow-200 font-semibold mb-1">
          {{ __('Confirm Password') }}
        </label>
        <input
          id="password_confirmation"
          type="password"
          wire:model="state.password_confirmation"
          autocomplete="new-password"
          class="w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="password_confirmation" class="text-red-500 text-sm mt-1" />
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end">
        <x-action-message class="text-green-400 mr-4" on="saved">
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
