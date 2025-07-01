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
          <button id="banners" class="affiliate-tools-tab bg-gray-800 text-yellow-300 px-4 py-2 rounded-t-lg">Banners</button
          > <button id="social" class="affiliate-tools-tab bg-gray-800 text-yellow-300 px-4 py-2 rounded-t-lg">Social Media</button>
        </div>

        <!-- Splash Pages -->
        <div id="splash_tab" class="affiliate-tools-content">

          <p class="mb-4">Ready-made landing pages you can send straight to prospects. Each link is pre-loaded with your affiliate username.</p>
          <div class="space-y-6">
            @foreach([1,2,3,4,5] as $id)
            <div class="flex items-center space-x-4">
              <a href="{{ url("/splash/{$id}/" . auth()->user()->username) }}" target="_blank">
                <img src="{{ asset("/img/splash{$id}_thumb.jpeg") }}" alt="Splash {{ $id }}" class="w-64 border rounded">
              </a>
              <div class="flex-1">
                <div class="font-bold text-yellow-300 mb-1">SPLASH PAGE LINK:</div>
                <input type="text"
                readonly
                class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1"
                value="{{ url("/splash/{$id}/" . auth()->user()->username) }}">
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
            [
            'subject' => "Step into the Ring and Dominate Your Ad Battles 💥",
            'body'    => "Hey {{ auth()->user()->name }},\n\nTired of watching your ads get buried in the noise? At Sell Or Die, your campaigns don’t just launch—they enter the ring. Our unique voting-based platform turns every ad into an unbeatable contender, pitting your creative against real competitors to see which one packs the biggest punch.\n\nImagine viewers casting votes, driving engagement, and sending you actionable feedback—all while you sit back and watch your traffic soar. With our AI-powered ad weapons, you get beautifully rendered HTML ads in seconds and in-depth performance insights that tell you exactly which headlines and images land the hardest.\n\nWhether you’re gloving up for free or stepping into the Heavyweight tier for priority exposure and bonus credits, Sell Or Die gives you the power to control the fight. Run multi-way battles, claw past the competition, and stack up votes—so you’re always one step closer to knockout results.\n\n🚀 Ready to Win? Enter the ring now:\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you in the ring!"
            ],
            [
            'subject' => "🏆 Vote, Surf & Earn Credits with Sell Or Die!",
            'body'    => "Hey {{ auth()->user()->name }},\n\nTired of mindless surfing with nothing to show for it? At Sell Or Die, every click is a chance to cast your vote—and rack up credits while you’re at it. Say goodbye to the old 1:1 exchange; here you’ll earn more than just page views.\n\nJump into fast-paced ad battles where your vote decides the winner. It’s more fun than endless scrolling—you’ll feel the thrill of the ring as you vote on eye-catching creatives and cheer for your favorites.\n\nNever wonder if your time was wasted again. With our boosted exchange rate, you’ll always earn bonus credits for each vote. Plus, you’ll learn firsthand why some ads crush it and others flop—real feedback that makes you smarter about what really works.\n\nReady to dive in? Start voting, earn credits, and discover the secrets behind winning ads now:\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you in the voting ring!"
            ],
            [
            'subject' => "💰 Earn \$100 per Sale—Join the Hottest New Ad Network!",
            'body'    => "Hey {{ auth()->user()->name }},\n\nReady to cash in on the next big thing? As a Sell Or Die affiliate, you’ll earn a whopping \$100 for every one-time offer sale you drive—no tiers, no tricks, just straight-up commissions.\n\nWhy is Sell Or Die so hot? We’re the world’s first ad voting exchange—our unique platform engages thousands of real voters, driving trust and delivering conversion rates that crush industry averages.\n\nWant to sell something everyone wants? Advertising—but not just any network. This is the hottest new marketplace where engagement meets profit. Advertisers flock here, so your links convert fast and your bank account grows even faster.\n\n🔥 Get started now and watch your referrals turn into \$100 paydays:\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you on the leaderboard!"
            ],            
            [
            'subject' => "🚀 Climb the Ad League & Go Viral Every Day!",
            'body'    => "Hey {{ auth()->user()->name }},\n\nReady to take your ads to the big leagues? At Sell Or Die, every fight enters our daily League—where the most-voted ads climb the leaderboard for all to see.\n\nWith each vote, your ad fires up higher in the rankings. Hit the top 10 and you’ll unlock viral exposure—millions of eyes on your creative and real-time feedback on what works (and what doesn’t).\n\nBest of all, the League resets every day, so you get a fresh shot at glory each morning. Vote-driven momentum means you’re always one click away from that knockout spotlight.\n\n🎯 Ready to rise through the ranks? Enter today and start your climb:\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you at the top of the leaderboard!",
            ],
            [
            'subject' => "🎤 Influencer Exclusive: Skyrocket Your Traffic with Sell Or Die!",
            'body'    => "Hey {{ auth()->user()->name }},\n\nI’ve seen you crush it as an influencer—and I know how hard it is to find fresh, engaging traffic sources. That’s why I’m excited to recommend Sell Or Die, the first-ever ad-voting exchange that turns every ad into a viral contest.\n\nThis isn’t your typical ad network. With real fans voting on your creative, you’ll enjoy unmatched engagement and discover what truly resonates with your audience. It’s the best new idea for driving traffic in years—and it’s already delivering conversion rates that blow industry averages out of the water.\n\nJoin under my link and I’ll hook you up with **500 bonus credits** to fuel your first battles. Your followers will love voting on eye-catching ads, and you’ll get insights that make every campaign stronger.\n\nReady to amplify your influence? Sign up now and claim your bonuses:\n{{ url('/aff/'.auth()->user()->username) }}\n\nCan’t wait to see you dominate the leaderboard!\n\n— [Your Name], Fellow Influencer & Sell Or Die Advocate"
            ],

            [
            'subject' => "🚀 My Secret Weapon for Explosive Traffic—Sell Or Die!",
            'body'    => "Hey everyone,\n\nAs an influencer constantly looking for fresh ways to get your content seen, I’ve discovered Sell Or Die—the world’s first ad-voting exchange. Instead of bland banner swaps, you enter fast-paced ‘ad battles’ where real people vote on the ads they love.\n\nWhy I’m recommending it: you get genuine engagement, learn what creative actually converts, and skyrocket your traffic without guessing. Every vote you drive helps you climb daily leaderboards—and that leaderboard spotlight means viral exposure for your brand.\n\nI’m inviting you to join under my link—use {{ url('/aff/'.auth()->user()->username) }}—and I’ll send you **300 bonus credits** to jumpstart your first ad battles.\n\nReady to level up? Copy this link and let’s dominate the ad game together:\n{{ url('/aff/'.auth()->user()->username) }}\n\nSee you in the ring! 💥"
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

        <!-- Social Media Content Panel -->
        <div id="social_tab" class="affiliate-tools-content hidden">
          <p class="mb-4">
            Share our latest posts, graphics, and campaign links directly to your social channels with pre-built assets.
          </p>
          <div class="space-y-4">
            <div>
              <div class="font-semibold text-yellow-300 mb-1">Instagram Post:</div>
              <textarea readonly rows="4"
              class="w-full bg-gray-800 text-white border border-yellow-300 rounded p-2 font-mono">
              🚀 Ready to level up your ad game? Join Sell Or Die and vote for your favorite ad battles to earn credits! 🌟

              Sign up: {{ url('/aff/'.auth()->user()->username) }}
              #SellOrDie #AdBattles #Marketing
            </textarea>
          </div>
          <div>
            <div class="font-semibold text-yellow-300 mb-1">Twitter Tweet:</div>
            <textarea readonly rows="3"
            class="w-full bg-gray-800 text-white border border-yellow-300 rounded p-2 font-mono">
            Vote in ad battles & earn credits daily! 🔥 Join me on @SellOrDie: {{ url('/aff/'.auth()->user()->username) }} #AdTech #Marketing
          </textarea>
        </div>
      </div>
    </div>        

    <!-- Banners -->
    <div id="banners_tab" class="affiliate-tools-content hidden">
      <p class="mb-4">Grab these banner ads and drop them into your site or any ad network. They include your affiliate link automatically.</p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="text-center">
          <img src="/img/banners/compete-728x90.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
          <textarea readonly
          rows="5"
          class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
          <a href="{{ url('/aff/'.auth()->user()->username) }}">
            <img src="/img/banners/compete-728x90.jpg" alt="Sell Or Die Banner">
          </a>
        </textarea>
      </div>
      <div class="text-center">
        <img src="/img/banners/struggle-728x90.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
        <textarea readonly
        rows="5"
        class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
        <a href="{{ url('/aff/'.auth()->user()->username) }}">
          <img src="/img/banners/struggle-728x90.jpg" alt="Sell Or Die Banner">
        </a>
      </textarea>
    </div>   
    <div class="text-center">
      <img src="/img/banners/weak-728x90.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
      <textarea readonly
      rows="5"
      class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
      <a href="{{ url('/aff/'.auth()->user()->username) }}">
        <img src="/img/banners/weak-728x90.jpg" alt="Sell Or Die Banner">
      </a>
    </textarea>
  </div>
  <div class="text-center">
    <img src="/img/banners/weak-300x250.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
    <textarea readonly
    rows="5"
    class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
    <a href="{{ url('/aff/'.auth()->user()->username) }}">
      <img src="/img/banners/weak-300x250.jpg" alt="Sell Or Die Banner">
    </a>
  </textarea>
</div>      
<div class="text-center">
  <img src="/img/banners/struggle-300x250.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/struggle-300x250.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div> 
<div class="text-center">
  <img src="/img/banners/compete-300x250.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/compete-300x250.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div> 
<div class="text-center">
  <img src="/img/banners/compete-320x100.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/compete-320x100.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>     

<div class="text-center">
  <img src="/img/banners/compete-160x600.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/compete-160x600.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>    

<div class="text-center">
  <img src="/img/banners/weak-160x600.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/weak-160x600.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>  

<div class="text-center">
  <img src="/img/banners/struggle-160x600.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/struggle-160x600.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>  

<div class="text-center">
  <img src="/img/banners/weak-300x600.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/weak-300x600.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>  

<div class="text-center">
  <img src="/img/banners/struggle-300x600.jpg" alt="Banner" class="mx-auto mb-2 border rounded">
  <textarea readonly
  rows="5"
  class="w-full bg-gray-800 text-white border border-yellow-300 rounded px-2 py-1 font-mono">
  <a href="{{ url('/aff/'.auth()->user()->username) }}">
    <img src="/img/banners/struggle-300x600.jpg" alt="Sell Or Die Banner">
  </a>
</textarea>
</div>        

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
