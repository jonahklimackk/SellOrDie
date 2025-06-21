<?php
$aff = Cookie::get('aff');
$campaignName= Cookie::get('campaign');

$campaign = App\Models\Campaigns::where('affiliate_id',App\Models\User::getSponsor()->id)->where('value', $campaignName)->get()->first();
?>
<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      {{-- Card --}}
      <div class="bg-gray-800 rounded-2xl shadow-2xl p-6">
        {{-- Logo --}}
        <div class="flex justify-center mb-6">
          <img src="/img/sellordie7.png" alt="SellOrDie Logo" width="200" height="200" />
        </div>

        {{-- Validation Errors --}}
        <x-validation-errors class="mb-4 text-red-400" />

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf

          {{-- Name --}}
          <div>
            <label for="name" class="block text-yellow-300 font-semibold mb-1">{{ __('Name') }}</label>
            <input
              id="name"
              name="name"
              type="text"
              value="{{ old('name') }}"
              required
              autofocus
              autocomplete="name"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          {{-- Username --}}
          <div>
            <label for="username" class="block text-yellow-300 font-semibold mb-1">{{ __('Username') }}</label>
            <input
              id="username"
              name="username"
              type="text"
              value="{{ old('username') }}"
              required
              autocomplete="username"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          {{-- Email --}}
          <div>
            <label for="email" class="block text-yellow-300 font-semibold mb-1">{{ __('Email') }}</label>
            <input
              id="email"
              name="email"
              type="email"
              value="{{ old('email') }}"
              required
              autocomplete="username"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          {{-- Password --}}
          <div>
            <label for="password" class="block text-yellow-300 font-semibold mb-1">{{ __('Password') }}</label>
            <input
              id="password"
              name="password"
              type="password"
              required
              autocomplete="new-password"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          {{-- Confirm Password --}}
          <div>
            <label for="password_confirmation" class="block text-yellow-300 font-semibold mb-1">{{ __('Confirm Password') }}</label>
            <input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              required
              autocomplete="new-password"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          {{-- Sponsor Info (read-only) --}}
          <div class="bg-gray-700 rounded-lg p-4 space-y-2 text-gray-300 text-sm">
            <div>{{ __('Your Sponsor') }}: {{ App\Models\User::getSponsor()->name }}</div>
            <div>{{ __('Sponsor Username') }}: {{ App\Models\User::getSponsor()->username }}</div>
            <div>{{ __('Sponsor ID') }}: {{ App\Models\User::getSponsor()->id }}</div>
          </div>
          <input type="hidden" name="sponsor_id" value="{{ App\Models\User::getSponsor()->id }}"/>
          <input type="hidden" name="campaign_id" value="{{ optional($campaign)->id }}"/>

          {{-- Terms & Privacy --}}
          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="flex items-start">
              <input
                id="terms"
                name="terms"
                type="checkbox"
                required
                class="h-4 w-4 text-yellow-500 bg-gray-700 border-gray-600 rounded focus:ring-yellow-300 mt-1"
              />
              <label for="terms" class="ml-2 text-gray-300 text-sm">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                  'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-yellow-300 hover:text-yellow-200">'.__('Terms of Service').'</a>',
                  'privacy_policy'  => '<a target="_blank" href="'.route('policy.show').'" class="underline text-yellow-300 hover:text-yellow-200">'.__('Privacy Policy').'</a>',
                ]) !!}
              </label>
            </div>
          @endif

          {{-- Actions --}}
          <div class="flex items-center justify-between">
            <a
              href="{{ route('login') }}"
              class="text-sm text-yellow-300 hover:text-yellow-200 underline focus:outline-none focus:ring-2 focus:ring-yellow-300"
            >
              {{ __('Already registered?') }}
            </a>

            <button
              type="submit"
              class="inline-flex justify-center px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold rounded-lg shadow-lg transition focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
            >
              {{ __('Register') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
