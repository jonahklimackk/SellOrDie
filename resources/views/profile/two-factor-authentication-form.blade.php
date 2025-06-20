<div class="mt-10 bg-gray-900 rounded-2xl shadow-2xl p-6">
  {{-- Title --}}
  <h2 class="text-2xl font-bold text-yellow-300 mb-2">
    {{ __('Two Factor Authentication') }}
  </h2>
  {{-- Description --}}
  <p class="text-gray-400 mb-6">
    {{ __('Add additional security to your account using two factor authentication.') }}
  </p>

  {{-- Status --}}
  <div class="bg-gray-800 rounded-xl shadow-md p-4 mb-6">
    <h3 class="text-lg font-semibold text-yellow-200">
      @if ($this->enabled)
        @if ($showingConfirmation)
          {{ __('Finish enabling two factor authentication.') }}
        @else
          {{ __('You have enabled two factor authentication.') }}
        @endif
      @else
        {{ __('You have not enabled two factor authentication.') }}
      @endif
    </h3>
    <p class="mt-2 text-sm text-gray-400">
      {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
    </p>
  </div>

  @if ($this->enabled)
    {{-- QR / Setup Key --}}
    @if ($showingQrCode)
      <div class="bg-gray-800 rounded-xl shadow-md p-4 mb-6">
        <p class="font-semibold text-yellow-200 text-sm mb-4">
          @if ($showingConfirmation)
            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
          @else
            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
          @endif
        </p>

        <div class="inline-block bg-white rounded-lg p-4 shadow-md">
          {!! $this->user->twoFactorQrCodeSvg() !!}
        </div>

        <p class="mt-4 font-mono text-sm text-gray-200">
          {{ __('Setup Key') }}: <span class="font-semibold">{{ decrypt($this->user->two_factor_secret) }}</span>
        </p>

        @if ($showingConfirmation)
          <div class="mt-4">
            <label for="code" class="block text-yellow-200 font-medium mb-1">{{ __('Code') }}</label>
            <input
              id="code"
              type="text"
              wire:model="code"
              wire:keydown.enter="confirmTwoFactorAuthentication"
              inputmode="numeric"
              autofocus
              autocomplete="one-time-code"
              class="w-1/2 bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
            <x-input-error for="code" class="text-red-500 text-sm mt-1" />
          </div>
        @endif
      </div>
    @endif

    {{-- Recovery Codes --}}
    @if ($showingRecoveryCodes)
      <div class="bg-gray-800 rounded-xl shadow-md p-4 mb-6">
        <p class="font-semibold text-yellow-200 text-sm mb-4">
          {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </p>
        <div class="grid grid-cols-2 gap-2 font-mono text-sm bg-gray-700 rounded-lg p-4">
          @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
            <div class="text-gray-200">{{ $code }}</div>
          @endforeach
        </div>
      </div>
    @endif
  @endif

  {{-- Actions (right-aligned) --}}
  <div class="flex flex-wrap justify-end gap-3">
    @if (! $this->enabled)
      <x-confirms-password wire:then="enableTwoFactorAuthentication">
        <button
          type="button"
          class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
        >
          {{ __('Enable') }}
        </button>
      </x-confirms-password>
    @else
      @if ($showingRecoveryCodes)
        <x-confirms-password wire:then="regenerateRecoveryCodes">
          <button
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition"
          >
            {{ __('Regenerate Recovery Codes') }}
          </button>
        </x-confirms-password>
      @elseif ($showingConfirmation)
        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
          <button
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition"
          >
            {{ __('Confirm') }}
          </button>
        </x-confirms-password>
      @else
        <x-confirms-password wire:then="showRecoveryCodes">
          <button
            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition"
          >
            {{ __('Show Recovery Codes') }}
          </button>
        </x-confirms-password>
      @endif

      @if ($showingConfirmation)
        <x-confirms-password wire:then="disableTwoFactorAuthentication">
          <button
            class="bg-gray-800 hover:bg-gray-700 text-yellow-200 font-medium px-5 py-2 rounded-lg shadow-md transition"
          >
            {{ __('Cancel') }}
          </button>
        </x-confirms-password>
      @else
        <x-confirms-password wire:then="disableTwoFactorAuthentication">
          <button
            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition"
          >
            {{ __('Disable') }}
          </button>
        </x-confirms-password>
      @endif
    @endif
  </div>
</div>
