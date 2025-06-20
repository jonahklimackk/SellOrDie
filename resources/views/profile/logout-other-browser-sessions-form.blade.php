<div class="mt-10 bg-gray-900 rounded-2xl shadow-2xl p-6">
  {{-- Title --}}
  <h2 class="text-2xl font-bold text-yellow-300 mb-2">
    {{ __('Browser Sessions') }}
  </h2>
  {{-- Description --}}
  <p class="text-gray-400 mb-6">
    {{ __('Manage and log out your active sessions on other browsers and devices.') }}
  </p>

  {{-- Content --}}
  <div class="space-y-6">
    <div class="max-w-xl text-sm text-gray-500">
      {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
    </div>

    @if (count($this->sessions) > 0)
      <div class="space-y-4">
        @foreach ($this->sessions as $session)
          <div class="flex items-center bg-gray-800 rounded-xl shadow-md p-4">
            <div class="text-yellow-200">
              @if ($session->agent->isDesktop())
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/>
                </svg>
              @else
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                </svg>
              @endif
            </div>
            <div class="ml-4">
              <div class="text-yellow-200 font-semibold">
                {{ $session->agent->platform() ?: __('Unknown') }} — {{ $session->agent->browser() ?: __('Unknown') }}
              </div>
              <div class="text-gray-400 text-sm">
                {{ $session->ip_address }} —
                @if ($session->is_current_device)
                  <span class="text-green-400 font-medium">{{ __('This device') }}</span>
                @else
                  {{ __('Last active') }} {{ $session->last_active }}
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    {{-- Logout Button (right-aligned) --}}
    <div class="flex justify-end">
      <button
        wire:click="confirmLogout"
        wire:loading.attr="disabled"
        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
      >
        {{ __('Log Out Other Browser Sessions') }}
      </button>
    </div>

    <x-action-message class="text-yellow-200 text-right" on="loggedOut">
      {{ __('Done.') }}
    </x-action-message>
  </div>

  {{-- Confirmation Modal --}}
  <x-dialog-modal wire:model.live="confirmingLogout">
    <x-slot name="title">
      <h3 class="text-xl font-bold text-yellow-300">{{ __('Log Out Other Browser Sessions') }}</h3>
    </x-slot>
    <x-slot name="content">
      <p class="text-gray-300">
        {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}
      </p>
      <div class="mt-4" x-data x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
        <input
          type="password"
          placeholder="{{ __('Password') }}"
          autocomplete="current-password"
          x-ref="password"
          wire:model="password"
          wire:keydown.enter="logoutOtherBrowserSessions"
          class="w-3/4 bg-gray-800 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
        />
        <x-input-error for="password" class="text-red-500 text-sm mt-1" />
      </div>
    </x-slot>
    <x-slot name="footer">
      <button
        wire:click="$toggle('confirmingLogout')"
        class="bg-gray-800 hover:bg-gray-700 text-yellow-200 font-medium px-4 py-2 rounded-lg shadow-md transition"
      >
        {{ __('Cancel') }}
      </button>
      <button
        wire:click="logoutOtherBrowserSessions"
        wire:loading.attr="disabled"
        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-md ml-3 transition"
      >
        {{ __('Log Out Other Browser Sessions') }}
      </button>
    </x-slot>
  </x-dialog-modal>
</div>
