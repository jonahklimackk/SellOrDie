<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">      
      <div class="bg-gray-800 rounded-2xl shadow-2xl p-6">
        <div class="flex justify-center mb-6">
          <x-authentication-card-logo />
        </div>

        <p class="text-gray-300 text-sm mb-4">
          {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn’t receive the email, we will gladly send you another.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
          <div class="mb-4 text-sm font-medium text-green-400">
            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
          </div>
        @endif

        <div class="mt-6 space-y-4">
          <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button
              type="submit"
              class="w-full inline-flex justify-center items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold uppercase rounded-lg shadow-md transition focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
            >
              {{ __('Resend Verification Email') }}
            </button>
          </form>

          <div class="flex justify-between items-center">
            <a
              href="{{ route('profile.show') }}"
              class="text-yellow-300 hover:text-yellow-200 text-sm font-medium underline focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
            >
              {{ __('Edit Profile') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button
                type="submit"
                class="text-yellow-300 hover:text-yellow-200 text-sm font-medium underline focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
              >
                {{ __('Log Out') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
