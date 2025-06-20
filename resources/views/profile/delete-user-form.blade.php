<div class="mt-10 bg-gray-900 rounded-2xl shadow-2xl p-6">
  {{-- Title --}}
  <h2 class="text-2xl font-bold text-yellow-300 mb-2">
    {{ __('Delete Account') }}
  </h2>
  {{-- Description --}}
  <p class="text-gray-400 mb-6">
    {{ __('Permanently delete your account.') }}
  </p>

  {{-- Warning --}}
  <div class="max-w-xl text-sm text-gray-500 mb-6">
    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
  </div>

  {{-- Delete Button (right-aligned) --}}
  <div class="flex justify-end">
    <button
      wire:click="confirmUserDeletion"
      wire:loading.attr="disabled"
      class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
    >
      {{ __('Delete Account') }}
    </button>
  </div>

  {{-- Confirmation Modal --}}
  <x-dialog-modal wire:model.live="confirmingUserDeletion">
    <x-slot name="title">
      <h3 class="text-xl font-bold text-yellow-300">
        {{ __('Delete Account') }}
      </h3>
    </x-slot>

    <x-slot name="content">
      <p class="text-gray-200">
        {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
      </p>

      <div class="mt-4" x-data x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
        <input
          type="password"
          placeholder="{{ __('Password') }}"
          autocomplete="current-password"
          x-ref="password"
          wire:model="password"
          wire:keydown.enter="deleteUser"
          class="w-3/4 bg-gray-800 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="password" class="text-red-500 text-sm mt-1" />
      </div>
    </x-slot>

    <x-slot name="footer">
      <div class="flex justify-end space-x-3">
        <button
          wire:click="$toggle('confirmingUserDeletion')"
          class="bg-gray-800 hover:bg-gray-700 text-yellow-200 font-medium px-4 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
        >
          {{ __('Cancel') }}
        </button>
        <button
          wire:click="deleteUser"
          wire:loading.attr="disabled"
          class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
        >
          {{ __('Delete Account') }}
        </button>
      </div>
    </x-slot>
  </x-dialog-modal>
</div>
