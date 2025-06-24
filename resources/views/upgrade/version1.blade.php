<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upgrade to Heavyweight</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://js.stripe.com/v3"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Container & sizing */
    #billing-label {
      display: inline-block;
      position: relative;
      width: 3rem;    /* 48px */
      height: 1.5rem; /* 24px */
    }
    /* The track (background) */
    #billing-label .switch-track {
      position: absolute;
      inset: 0;
      background-color: #374151; /* gray-700 */
      border-radius: 9999px;
      transition: background-color 0.2s;
    }
    /* The thumb (circle) */
    #billing-label .switch-thumb {
      position: absolute;
      top: 0.25rem; /* 4px */
      left: 0.25rem; /* 4px */
      width: 1rem;   /* 16px */
      height: 1rem;  /* 16px */
      background-color: white;
      border-radius: 9999px;
      transition: transform 0.2s ease-in-out;
    }
    /* When “yearly” mode is active on the label… */
    #billing-label.yearly .switch-track {
      background-color: #FBBD24; /* yellow-400 */
    }
    #billing-label.yearly .switch-thumb {
      transform: translateX(1.5rem); /* 24px to the right */
    }
  </style>


</head>
<body class="bg-gray-900 text-gray-100 font-sans">
  <section class="max-w-5xl mx-auto p-6">
    <div class="text-center">
      <h1 class="text-4xl font-extrabold text-yellow-400 mb-2">🥊 Upgrade to HEAVYWEIGHT STATUS</h1>
      <p class="text-xl mb-6">Dominate the Ad Arena. Crush the Competition.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-12">
      <div class="bg-gray-800 p-6 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-yellow-300 mb-4">Why Go Heavyweight?</h2>
        <ul class="space-y-3 list-disc list-inside text-lg">
          <li><strong>Priority Ad Placement:</strong> Always show up first</li>
          <li><strong>Supercharged Voting Power:</strong> Double your impact</li>
          <li><strong>Exclusive Battles:</strong> Compete in elite ad matchups</li>
          <li><strong>Advanced Analytics:</strong> Heatmaps, breakdowns, and more</li>
          <li><strong>VIP Recognition:</strong> Public badge and leaderboard exposure</li>
        </ul>
      </div>

      <div class="bg-gray-800 p-6 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-yellow-300 mb-4">Who Should Upgrade?</h2>
        <p class="text-lg leading-relaxed">
          If you're a serious affiliate, agency, or entrepreneur looking to dominate the marketing battlefield, Heavyweight Status gives you the tools, exposure, and credibility to rise above the rest.
        </p>
      </div>
    </div>

    <!-- New Feature Comparison Section -->
    <section class="mb-12">
      <h2 class="text-3xl font-bold text-center text-yellow-300 mb-6">⚔️ Feature Comparison</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 text-gray-100 rounded-2xl overflow-hidden">
          <thead>
            <tr>
              <th class="px-4 py-2 bg-gray-700 text-left">Feature</th>
              <th class="px-4 py-2 bg-gray-700 text-center">Amateur</th>
              <th class="px-4 py-2 bg-gray-700 text-center">Lightweight</th>
              <th class="px-4 py-2 bg-gray-700 text-center">Heavyweight</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Ad Weapon</td>
              <td class="px-4 py-2 text-center">Text only</td>
              <td class="px-4 py-2 text-center">Full HTML WYSIWYG</td>
              <td class="px-4 py-2 text-center">AI-generated ads</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Cost to Display Ad Weapon</td>
              <td class="px-4 py-2 text-center">50 credits</td>
              <td class="px-4 py-2 text-center">30 credits</td>
              <td class="px-4 py-2 text-center">20 credits</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Credits per Vote</td>
              <td class="px-4 py-2 text-center">20–60</td>
              <td class="px-4 py-2 text-center">30–70</td>
              <td class="px-4 py-2 text-center">50–100</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Max # of Fights</td>
              <td class="px-4 py-2 text-center">3</td>
              <td class="px-4 py-2 text-center">10</td>
              <td class="px-4 py-2 text-center">25</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Login Ads?</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">Yes</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Banner Ad on Surf Page</td>
              <td class="px-4 py-2 text-center">Yes</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">No</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Priority Support</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">Yes</td>
              <td class="px-4 py-2 text-center">Yes</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Bonus Credits</td>
              <td class="px-4 py-2 text-center">0</td>
              <td class="px-4 py-2 text-center">10,000/month</td>
              <td class="px-4 py-2 text-center">50,000/month</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Random Opponent Placement</td>
              <td class="px-4 py-2 text-center">Third</td>
              <td class="px-4 py-2 text-center">Second</td>
              <td class="px-4 py-2 text-center">First</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Test Ads via 2-way Fights</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">Yes</td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="px-4 py-2">Choose Opponents (Free Members)</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">No</td>
              <td class="px-4 py-2 text-center">Yes</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <section class="bg-gradient-to-r from-gray-800 to-gray-700 py-12 px-6 rounded-2xl mb-12">
      <div class="max-w-4xl mx-auto text-center mb-8">
        <h2 class="text-3xl font-extrabold text-yellow-300 flex items-center justify-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 9v2m0 4v2m-4-2h.01m8 0h.01M6 16h.01M18 16h.01M9 12h.01m6 0h.01" />
          </svg>
          💡 Key Benefits
        </h2>
        <p class="text-gray-400">Everything you get when you power up to paid membership</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-lg text-gray-100">
        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 010-1.414z"/>
          </svg>
          <div>
            <strong class="text-white">Eye-Catching Rich HTML Ads</strong><br>
            Automatically generate a stunning “ad weapon” that stops scrollers in their tracks.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2 11a1 1 0 011-1h12a1 1 0 110 2H3a1 1 0 01-1-1z"/>
          </svg>
          <div>
            <strong class="text-white">Stretch Your Credits</strong><br>
            Pay less per display—your credits will last longer, fight after fight.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12h2v2H9v-2zm0-4h2v2H9V8zm1-6a8 8 0 11-5.292 14.292l-1.414-1.414A6 6 0 1015 8h-2a4 4 0 11-3-6z"/>
          </svg>
          <div>
            <strong class="text-white">Boosted Exposure</strong><br>
            Vote once and see your fight shown 1.5–2× more times with paid membership.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 000 2h14a1 1 0 100-2H3zM3 8a1 1 0 000 2h14a1 1 0 100-2H3zM3 12a1 1 0 000 2h14a1 1 0 100-2H3z"/>
          </svg>
          <div>
            <strong class="text-white">Multi-Way Advertising</strong><br>
            Run multiple fights across all your programs—maximizing reach and results.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 2a3 3 0 00-3 3v2a3 3 0 003 3v5a2 2 0 002 2h6a2 2 0 002-2v-5a3 3 0 003-3V5a3 3 0 00-3-3H5z"/>
          </svg>
          <div>
            <strong class="text-white">Login & Banner Ads</strong><br>
            Only Heavyweights get “prime real estate” ad slots—no exceptions.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 100 12 6 6 0 000-12zM2 10a8 8 0 1116 0 8 8 0 01-16 0z"/>
          </svg>
          <div>
            <strong class="text-white">Ad-Free Focus</strong><br>
            Eliminate distractions—your ad weapons take center stage for maximum impact.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/>
          </svg>
          <div>
            <strong class="text-white">Rapid Response</strong><br>
            Get answers to your questions within hours—not days.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 3h14v2H3V3zm0 4h14v2H3V7zm0 4h14v2H3v-2zm0 4h14v2H3v-2z"/>
          </svg>
          <div>
            <strong class="text-white">Hands-Off Traffic</strong><br>
            Set it and forget it—hundreds of daily hits on autopilot.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M7 4a3 3 0 100 6 3 3 0 000-6zM13 4a3 3 0 100 6 3 3 0 000-6zM9 10v7h2v-7H9z"/>
          </svg>
          <div>
            <strong class="text-white">Priority Visibility</strong><br>
            Paid members always see votes—and results—first.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 4h10v2H5V4zm0 4h10v2H5V8zm0 4h10v2H5v-2zm0 4h10v2H5v-2z"/>
          </svg>
          <div>
            <strong class="text-white">Performance Insights</strong><br>
            See which ads win—then roll out the champions for bigger wins.
          </div>
        </div>

        <div class="flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 5h14l-7 10L3 5z"/>
          </svg>
          <div>
            <strong class="text-white">Guaranteed Easy Wins</strong><br>
            Pit your fights against free members—and scoop up traffic & sales.
          </div>
        </div>
      </div>
    </section>


    <section class="bg-gray-900 text-gray-100 py-16">
      <div class="max-w-5xl mx-auto text-center mb-12">
        <h2 class="text-4xl font-extrabold text-yellow-400">Choose Your Plan</h2>
        <p class="mt-2 text-lg">Pick the tier that matches your goals—Free to get started, or unlock full power with Lightweight or Heavyweight.</p>
      </div>


      <!-- Billing Toggle -->
      <!-- Billing Toggle -->
      <div class="flex items-center justify-center mb-8 space-x-4">
        <span class="text-gray-400">Monthly</span>

        <label id="billing-label">
          <input id="billing-toggle" type="checkbox" class="sr-only" />
          <span class="switch-track"></span>
          <span class="switch-thumb"></span>
        </label>

        <span class="text-gray-400">Yearly</span>
        <span class="ml-2 text-sm text-green-400">Save up to 25%</span>
      </div>


      <script>
        const toggle = document.getElementById('billing-toggle');
        const label  = document.getElementById('billing-label');

        toggle.addEventListener('change', () => {
    // Slide the slider track/thumb
          label.classList.toggle('yearly');

    // Swap your prices
          document.querySelectorAll('.monthly').forEach(el => el.classList.toggle('hidden'));
          document.querySelectorAll('.yearly').forEach(el => el.classList.toggle('hidden'));
        });
      </script>





<!-- Pricing Cards -->
<div class="flex flex-col lg:flex-row gap-8 max-w-5xl mx-auto">
  <!-- Amateur -->
  <div class="flex-1 bg-gray-800 rounded-2xl shadow-xl p-8 flex flex-col">
    <h3 class="text-2xl font-semibold mb-4">Amateur</h3>
    <p class="text-5xl font-bold mb-2">Free</p>
    <p class="mb-6">Always free. No card required.</p>
    <ul class="flex-1 mb-6 space-y-3 text-left">
      <li>✔️ Basic Text-Only Ads</li>
      <li>✔️ 50 credits/display</li>
      <li>✔️ 20–60 credits/vote</li>
      <li>✔️ Up to 3 fights</li>
    </ul>
    <a
      href="/signup"
      class="mt-auto bg-yellow-400 text-black font-semibold px-6 py-3 rounded-xl text-center hover:bg-yellow-300 transition"
    >
      Get Started
    </a>
  </div>

  <!-- Lightweight (Most Popular) -->
  <div class="flex-1 bg-gray-800 rounded-2xl shadow-2xl border-4 border-yellow-400 p-8 flex flex-col">
    <div class="mb-4">
      <span class="inline-block bg-yellow-400 text-black uppercase text-xs font-bold px-3 py-1 rounded-full">Most Popular</span>
    </div>
    <h3 class="text-2xl font-semibold mb-4">Lightweight</h3>
    <!-- Monthly Price -->
    <p class="monthly text-5xl font-bold mb-1">$27<span class="text-2xl font-medium">/mo</span></p>
    <!-- Yearly Price -->
    <p class="yearly hidden text-5xl font-bold mb-1">$197<span class="text-2xl font-medium">/yr</span></p>
    <ul class="flex-1 mb-6 space-y-3 text-left">
      <li>✔️ Full HTML WYSIWYG Ads</li>
      <li>✔️ 30 credits/display</li>
      <li>✔️ 30–70 credits/vote</li>
      <li>✔️ 150,000 credits / month</li>
      <li>✔️ Up to 10 fights</li>
      <li>✔️ Priority email support</li>
    </ul>
    <!-- Stripe Payment Links -->
    <a
      href="https://buy.stripe.com/4gMeVdaJ7bv6cND5zG6kg00"
      class="monthly mt-auto bg-yellow-400 text-black font-semibold px-6 py-3 rounded-xl text-center hover:bg-yellow-300 transition"
    >
      Subscribe $27/mo
    </a>
    <a
      href="https://buy.stripe.com/28EfZh7wVczadRH0fm6kg01"
      class="yearly hidden mt-auto bg-yellow-400 text-black font-semibold px-6 py-3 rounded-xl text-center hover:bg-yellow-300 transition"
    >
      Subscribe $197/yr
    </a>
  </div>

  <!-- Heavyweight -->
  <div class="flex-1 bg-gray-800 rounded-2xl shadow-xl p-8 flex flex-col">
    <h3 class="text-2xl font-semibold mb-4">Heavyweight</h3>
    <!-- Monthly Price -->
    <p class="monthly text-5xl font-bold mb-1">$47<span class="text-2xl font-medium">/mo</span></p>
    <!-- Yearly Price -->
    <p class="yearly hidden text-5xl font-bold mb-1">$297<span class="text-2xl font-medium">/yr</span></p>
    <ul class="flex-1 mb-6 space-y-3 text-left">
      <li>✔️ AI-Generated Ads</li>
      <li>✔️ 20 credits/display</li>
      <li>✔️ 50–100 credits/vote</li>
      <li>✔️ 300,000 credits / month</li>
      <li>✔️ Up to 25 fights</li>
      <li>✔️ Login & banner ads</li>
      <li>✔️ VIP support</li>
    </ul>
    <!-- Stripe Payment Links -->
    <a
      href="https://buy.stripe.com/eVqeVd3gFeHi00Rfag6kg03"
      class="monthly mt-auto bg-yellow-400 text-black font-semibold px-6 py-3 rounded-xl text-center hover:bg-yellow-300 transition"
    >
      Subscribe $47/mo
    </a>
    <a
      href="https://buy.stripe.com/4gMeVdbNbgPq6pf4vC6kg04"
      class="yearly hidden mt-auto bg-yellow-400 text-black font-semibold px-6 py-3 rounded-xl text-center hover:bg-yellow-300 transition"
    >
      Subscribe $297/yr
    </a>
  </div>
</div>



      <div class="max-w-5xl mx-auto text-center mt-12">
        <a href="#features" class="text-gray-400 hover:text-yellow-400 transition">View all features →</a>
      </div>
    </section>


<!--     <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4 text-yellow-300">💸 Choose Your Plan</h2>
      <p class="text-lg mb-6">Only <strong>$27/month</strong> or <strong>$197/year</strong> (4 months free!)</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="https://buy.stripe.com/4gMeVdaJ7bv6cND5zG6kg00">
          <button onclick="checkout('price_monthly')" class="px-6 py-3 bg-yellow-400 text-black font-semibold rounded-xl shadow hover:bg-yellow-300 transition">
            Subscribe Monthly – $27/mo
          </button>
        </a>
        <a href="https://buy.stripe.com/28EfZh7wVczadRH0fm6kg01">
          <button onclick="checkout('price_yearly')" class="px-6 py-3 bg-yellow-500 text-black font-semibold rounded-xl shadow hover:bg-yellow-400 transition">
            Subscribe Yearly – $197/yr
          </button>
        </a>
      </div>
    </div> -->

<!--     <div class="mb-12">
      <h2 class="text-3xl font-bold text-center text-yellow-300 mb-6">📊 Free vs Heavyweight Comparison</h2>
      <canvas id="comparisonChart" class="max-w-2xl mx-auto"></canvas>
    </div> -->

    <div class="bg-gray-800 p-6 rounded-2xl shadow-xl max-w-3xl mx-auto">
      <h2 class="text-2xl font-bold text-yellow-300 mb-4">🏆 Real Results</h2>
      <blockquote class="italic border-l-4 border-yellow-400 pl-4 mb-4">
        “Once I went Heavyweight, my ad visibility tripled. I got over 500% more votes and doubled my conversions.” – Jenna M.
      </blockquote>
      <blockquote class="italic border-l-4 border-yellow-400 pl-4">
        “This isn’t some ‘traffic exchange.’ This is <strong>marketing war</strong>. And when you’re a Heavyweight, you win sales.” – Luis R.
      </blockquote>
    </div>
  </section>




  <script>
    const stripe = Stripe('pk_test_your_public_key_here'); // Replace with your real Stripe public key
    function checkout(priceId) {
      stripe.redirectToCheckout({
        lineItems: [{ price: priceId, quantity: 1 }],
        mode: 'subscription',
        successUrl: window.location.origin + '/success.html',
        cancelUrl: window.location.origin + '/cancel.html'
      }).then(result => {
        if (result.error) alert(result.error.message);
      });
    }

    const ctx = document.getElementById('comparisonChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Ad Placement', 'Vote Power', 'Match Access', 'Analytics', 'Support'],
        datasets: [
        {
          label: 'Free User',
          data: [2, 1, 1, 1, 1],
          backgroundColor: 'rgba(156, 163, 175, 0.4)',
          borderColor: 'rgba(156, 163, 175, 1)',
          borderWidth: 1
        },
        {
          label: 'Heavyweight',
          data: [5, 4, 5, 5, 5],
          backgroundColor: 'rgba(251, 191, 36, 0.6)',
          borderColor: 'rgba(251, 191, 36, 1)',
          borderWidth: 1
        }
        ]
      },
      options: {
        scales: {
          y: { beginAtZero: true, max: 5, ticks: { color: '#d1d5db' }, grid: { color: '#374151' } },
          x: { ticks: { color: '#d1d5db' }, grid: { color: '#374151' } }
        },
        plugins: { legend: { labels: { color: '#fff' } } }
      }
    });
  </script>
</body>
</html>
