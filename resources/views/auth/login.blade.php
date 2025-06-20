<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="bg-gray-800 rounded-2xl shadow-2xl p-6">
        <div class="flex justify-center mb-6">
          <img src="/img/sellordie7.png" alt="SellOrDie Logo" width="200" height="200" />
        </div>

        <x-validation-errors class="mb-4 text-red-400" />

        @if(session('status'))
          <div class="mb-4 text-sm text-green-400">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
          @csrf

          <div>
            <label for="email" class="block text-yellow-300 font-semibold mb-1">{{ __('Email') }}</label>
            <input
              id="email"
              type="email"
              name="email"
              value="{{ old('email') }}"
              required
              autofocus
              autocomplete="username"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          <div>
            <label for="password" class="block text-yellow-300 font-semibold mb-1">{{ __('Password') }}</label>
            <input
              id="password"
              type="password"
              name="password"
              required
              autocomplete="current-password"
              class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg border-transparent focus:border-yellow-400 focus:ring focus:ring-yellow-300 focus:ring-opacity-50"
            />
          </div>

          <div class="flex items-center">
            <input
              id="remember_me"
              type="checkbox"
              name="remember"
              class="h-4 w-4 text-yellow-500 bg-gray-700 border-gray-600 rounded focus:ring-yellow-300"
            />
            <label for="remember_me" class="ml-2 block text-sm text-gray-300">
              {{ __('Remember me') }}
            </label>
          </div>

          <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
              <a
                href="{{ route('password.request') }}"
                class="text-sm text-yellow-300 hover:text-yellow-200 underline focus:outline-none focus:ring-2 focus:ring-yellow-300"
              >
                {{ __('Forgot your password?') }}
              </a>
            @endif

            <button
              type="submit"
              class="inline-flex justify-center px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold rounded-lg shadow-lg transition focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50"
            >
              {{ __('Log in') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
