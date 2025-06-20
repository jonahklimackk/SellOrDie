<x-app-layout>
  <div class="py-0 flex justify-center">
    <div class="w-full max-w-3xl space-y-8">
      @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
<!--           <h3 class="text-xl font-bold text-yellow-300 mb-4">
            {{ __('Update Profile Information') }}
          </h3> -->
          @livewire('profile.update-profile-information-form')
        </div>
      @endif

      @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
<!--           <h3 class="text-xl font-bold text-yellow-300 mb-4">
            {{ __('Update Password') }}
          </h3> -->
          @livewire('profile.update-password-form')
        </div>
      @endif

      @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
<!--           <h3 class="text-xl font-bold text-yellow-300 mb-4">
            {{ __('Two-Factor Authentication') }}
          </h3> -->
          @livewire('profile.two-factor-authentication-form')
        </div>
      @endif

      <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
<!--         <h3 class="text-xl font-bold text-yellow-300 mb-4">
          {{ __('Browser Sessions') }}
        </h3> -->
        @livewire('profile.logout-other-browser-sessions-form')
      </div>

      @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <div class="bg-gray-900 rounded-2xl shadow-2xl p-6">
<!--           <h3 class="text-xl font-bold text-yellow-300 mb-4">
            {{ __('Delete Account') }}
          </h3> -->
          @livewire('profile.delete-user-form')
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
