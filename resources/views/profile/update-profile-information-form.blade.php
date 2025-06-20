<div class="mt-10 flex justify-center">
  <div class="w-full max-w-3xl bg-gray-900 rounded-2xl shadow-2xl p-6">
    {{-- Header --}}
    <h2 class="text-2xl font-bold text-yellow-300 mb-2">
      {{ __('Profile Information') }}
    </h2>
    <p class="text-gray-400 mb-6">
      {{ __("Update your account's profile information and email address.") }}
    </p>

    <form wire:submit.prevent="updateProfileInformation" class="space-y-6">
      {{-- Profile Photo --}}
      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="bg-gray-800 rounded-xl shadow-md p-4">
          <label class="block text-yellow-200 font-semibold mb-2">
            {{ __('Photo') }}
          </label>

          <input type="file" id="photo" class="hidden"
                 wire:model.live="photo" x-ref="photo"
                 x-on:change="
                   photoName = $refs.photo.files[0].name;
                   const reader = new FileReader();
                   reader.onload = e => photoPreview = e.target.result;
                   reader.readAsDataURL($refs.photo.files[0]);
                 " />

          <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full bg-gray-700 overflow-hidden">
              <template x-if="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="object-cover w-full h-full">
              </template>
              <template x-if="photoPreview">
                <span class="block w-full h-full bg-cover bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
              </template>
            </div>

            <div class="space-x-2">
              <button type="button" x-on:click.prevent="$refs.photo.click()"
                      class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50">
                {{ __('Select New Photo') }}
              </button>

              @if ($this->user->profile_photo_path)
                <button type="button" wire:click="deleteProfilePhoto"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition">
                  {{ __('Remove Photo') }}
                </button>
              @endif
            </div>
          </div>

          <x-input-error for="photo" class="text-red-500 text-sm mt-2" />
        </div>
      @endif

      {{-- Name --}}
      <div class="bg-gray-800 rounded-xl shadow-md p-4">
        <label for="name" class="block text-yellow-200 font-semibold mb-1">
          {{ __('Name') }}
        </label>
        <input id="name" type="text" wire:model="state.name" required autocomplete="name"
               class="w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50" />
        <x-input-error for="name" class="text-red-500 text-sm mt-1" />
      </div>

      {{-- Email --}}
      <div class="bg-gray-800 rounded-xl shadow-md p-4">
        <label for="email" class="block text-yellow-200 font-semibold mb-1">
          {{ __('Email') }}
        </label>
        <input id="email" type="email" wire:model="state.email" required autocomplete="username"
               class="w-full bg-gray-700 text-gray-100 rounded-lg p-2 border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50" />
        <x-input-error for="email" class="text-red-500 text-sm mt-1" />

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
          <p class="text-sm text-yellow-200 mt-2">
            {{ __('Your email address is unverified.') }}
            <button type="button" wire:click.prevent="sendEmailVerification"
                    class="underline hover:text-yellow-300">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>
          @if ($this->verificationLinkSent)
            <p class="text-sm text-green-400 mt-1">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        @endif
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end">
        <x-action-message class="text-green-400 mr-4" on="saved">
          {{ __('Saved.') }}
        </x-action-message>
        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md transition focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50">
          {{ __('Save') }}
        </button>
      </div>
    </form>
  </div>
</div>
