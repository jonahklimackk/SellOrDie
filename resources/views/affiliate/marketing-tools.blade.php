<x-app-layout>
  <div class="py-12 bg-[#1f1c27] text-white min-h-screen">


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                      {{-- Sub-menu --}}
      <x-affiliate.submenu />

      <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-2xl p-6">
        <!-- Page Title -->
        <h3 class="text-2xl font-bold text-yellow-300 mb-6">Affiliate Marketing Tools</h3>

        <!-- Tabs -->
        <div class="flex space-x-2 mb-6">
          <button id="splash" class="affiliate-tools-tab bg-yellow-300 text-gray-900 px-4 py-2 rounded-t-lg">Splash Pages</button>
          <button id="email"  class="affiliate-tools-tab bg-gray-800 text-yellow-300 px-4 py-2 rounded-t-lg">Email Promos</button>
          <button id="banners" class="affiliate-tools-tab bg-gray-800 text-yellow-300 px-4 py-2 rounded-t-lg">Banners</button>
        </div>

        <!-- Splash Pages -->
        <div id="splash_tab" class="affiliate-tools-content">
          <p class="mb-4">Ready-made landing pages you can send straight to prospects. Each link is pre-loaded with your affiliate username.</p>
          <div class="space-y-6">
            @foreach([1,2,3,4,5] as $id)
              <div class="flex items-center space-x-4">
                <a href="{{ url("/splash/id/{$id}/u/" . auth()->user()->username) }}" target="_blank">
                  <img src="{{ asset("upload/splashes/Splash_00{$id}.png") }}" alt="Splash {{ $id }}" class="w-64 border rounded">
                </a>
                <div class="flex-1">
                  <div class="font-bold text-yellow-300 mb-1">SPLASH PAGE LINK:</div>
                  <input type="text"
                         readonly
                         class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1"
                         value="{{ url("/splash/id/{$id}/u/" . auth()->user()->username) }}">
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Email Promos -->
        <div id="email_tab" class="affiliate-tools-content hidden">
          <p class="mb-4">Copy-and-paste these email templates into your own list or other platforms.</p>
          <div class="space-y-8">
            @php
              $emails = [
                [
                  'subject' => "🔥 Supercharge your ads with Sell Or Die!",
                  'body'    => "Hey {{ auth()->user()->name }},\n\nWant to get your ad weapon seen by thousands of engaged voters?\n\nJoin Sell Or Die now in under 5 minutes:\n\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you in the ring!"
                ],
                // add more templates as needed
              ];
            @endphp

            @foreach($emails as $idx => $email)
              <div>
                <div class="font-semibold text-yellow-300 mb-1">EMAIL #{{ $idx+1 }} – Subject:</div>
                <input type="text"
                       readonly
                       class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1"
                       value="{{ $email['subject'] }}">
                <textarea readonly
                          rows="8"
                          class="mt-2 w-full bg-gray-800 text-white border border-yellow-300 rounded p-2 font-mono">{{ $email['body'] }}</textarea>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Banners -->
        <div id="banners_tab" class="affiliate-tools-content hidden">
          <p class="mb-4">Grab these banner ads and drop them into your site or any ad network. They include your affiliate link automatically.</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([1,2,3,4] as $id)
              <div class="text-center">
                <img src="{{ asset("upload/banners/{$id}.png") }}" alt="Banner {{ $id }}" class="mx-auto mb-2 border rounded">
                <textarea readonly
                          rows="3"
                          class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
<a href="{{ url('/aff/'.auth()->user()->username) }}">
  <img src="{{ url("upload/banners/{$id}.png") }}" alt="Sell Or Die Banner">
</a>
                </textarea>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.affiliate-tools-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.affiliate-tools-tab').forEach(t => {
          t.classList.remove('bg-yellow-300','text-gray-900');
          t.classList.add('bg-gray-800','text-yellow-300');
        });
        tab.classList.remove('bg-gray-800','text-yellow-300');
        tab.classList.add('bg-yellow-300','text-gray-900');
        document.querySelectorAll('.affiliate-tools-content').forEach(c => c.classList.add('hidden'));
        document.getElementById(tab.id + '_tab').classList.remove('hidden');
      });
    });
  </script>
</x-app-layout>
