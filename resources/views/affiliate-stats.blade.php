<x-app-layout>
  <div class="py-12 bg-[#1f1c27]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-800 ring-2 ring-yellow-400 overflow-hidden shadow-2xl sm:rounded-2xl">

        <div class="p-6 lg:p-8">
          <!-- Header -->
          <h1 class="text-4xl font-bold text-yellow-300 mb-6">
            🥊 Your Sell Or Die Affiliate Stats
          </h1>
          <p class="text-gray-300 mb-4">
            We make promoting Sell Or Die as easy and as effective as possible by tracking your ads for you!
          </p>
          <p class="text-gray-300 mb-4">
            This feature allows you to track all the clicks you receive on your affiliate links.
          </p>

          <!-- How it works -->
          <div class="mt-6 mb-6">
            <h2 class="text-2xl font-semibold text-yellow-300 mb-3">How it works:</h2>
            <ol class="list-decimal list-inside text-gray-300 space-y-2">
              <li>
                For each campaign you run, customize the end of your link so we can track it separately.
              </li>
              <li>
                Example for a list-builder ad:
                <div class="mt-1">
                  <a href="/aff/{{ Auth::user()->username }}/listbuilderad"
                     class="inline-block text-yellow-300 font-medium underline">
                    http://SellOrDie.online/aff/{{ Auth::user()->username }}/listbuilderad
                  </a>
                </div>
              </li>
              <li>
                Or for a traffic-exchange ad:
                <div class="mt-1">
                  <a href="/aff/{{ Auth::user()->username }}/trafficexchangead"
                     class="inline-block text-yellow-300 font-medium underline">
                    http://SellOrDie.online/aff/{{ Auth::user()->username }}/trafficexchangead
                  </a>
                </div>
              </li>
              <li>
                We track every click, join, and sale—and display your top-performers below.
              </li>
            </ol>
          </div>

          <!-- Stats Table -->
          <div class="overflow-x-auto bg-gray-900 rounded-lg ring-1 ring-yellow-500 p-4">
            <table class="min-w-full divide-y divide-gray-700">
              <thead class="bg-yellow-500">
                <tr>
                  <th class="px-4 py-2 text-left text-gray-900">#</th>
                  <th class="px-4 py-2 text-left text-gray-900">Track Code</th>
                  <th class="px-4 py-2 text-left text-gray-900">Clicks</th>
                  <th class="px-4 py-2 text-left text-gray-900">Joins</th>
                  <th class="px-4 py-2 text-left text-gray-900">Sales</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-700">
                @forelse($campaigns as $campaign)
                  <tr class="bg-gray-800 hover:bg-gray-700 transition">
                    <td class="px-4 py-3 text-yellow-300 font-medium">{{ $loop->index + 1 }}</td>
                    <td class="px-4 py-3 text-gray-200">{{ $campaign->value }}</td>
                    <td class="px-4 py-3 text-gray-200">{{ $campaign->raw }}</td>
                    <td class="px-4 py-3 text-gray-200">{{ $campaign->joins }}</td>
                    <td class="px-4 py-3 text-gray-200">{{ $campaign->sales }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                      No campaigns tracked yet. Start promoting to see your stats here!
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
