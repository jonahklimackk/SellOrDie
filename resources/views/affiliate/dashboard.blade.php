<x-app-layout>
  <div class="py-12 bg-[#1f1c27] text-white min-h-screen">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

      {{-- Sub-menu --}}
      <x-affiliate.submenu />

      {{-- Welcome Hero --}}
      <section class="bg-gray-900 p-8 sm:p-12 rounded-2xl shadow-2xl mb-12 text-center">
        <h1 class="text-4xl font-bold text-yellow-300 mb-4">Welcome to Our Affiliate Program</h1>
        <p class="text-gray-300 mb-6">Join the most innovative ad-voting affiliate network and start earning big!</p>
        <a href="{{ url('/affiliate/upgrade') }}" class="inline-block bg-yellow-300 text-gray-900 font-semibold px-6 py-3 rounded-lg hover:bg-yellow-400 transition">Upgrade to Heavyweight &amp; Earn More</a>
      </section>

      {{-- Why We're the Best --}}
      <section class="mb-12">
        <h2 class="text-2xl font-semibold text-yellow-300 mb-4">Why Our Affiliate Offer Is Unmatched</h2>
        <ul class="list-disc list-inside space-y-2 text-gray-300">
          <li>🚀 Brand-new ad-voting model—no competition has this unique engagement system.</li>
          <li>💰 High conversion rates—our members convert at <strong>up to 20%+</strong> on average.</li>
          <li>🔥 Weekly payouts—get your commissions in your account every Friday.</li>
          <li>🎯 Exclusive tools—banner ads, splash pages, email copy, social media posts, and more.</li>
          <li>🏆 Earn credits for every referral who signs up—even free members earn commissions.</li>
        </ul>
      </section>

      {{-- Benefits --}}
      <section class="mb-12 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gray-800 p-6 rounded-lg">
          <h3 class="text-xl font-semibold text-yellow-300 mb-3">For Upgraded Members (Heavyweight)</h3>
          <ul class="list-disc list-inside space-y-2 text-gray-300">
            <li>Earn up to <strong>$100 per sale</strong>.</li>
            <li>Priority ad placement—your ads show before free members.</li>
            <li>Access to premium marketing materials &amp; analytics.</li>
            <li>Higher commission tiers and special bonuses.</li>
          </ul>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg">
          <h3 class="text-xl font-semibold text-yellow-300 mb-3">For All Affiliates</h3>
          <ul class="list-disc list-inside space-y-2 text-gray-300">
            <li>Referral dashboard to track clicks, joins, and commissions.</li>
            <li>Custom affiliate links for every splash page and banner.</li>
            <li>Email templates &amp; recommendation emails ready to send.</li>
            <li>Social media post content for easy sharing.</li>
          </ul>
        </div>
      </section>

      {{-- Call to Action --}}
      <section class="text-center mb-12">
        <p class="text-gray-300 mb-4">Not upgraded yet? Unlock your full earning potential and stand out from the crowd!</p>
        <a href="{{ url('/affiliate/upgrade') }}" class="inline-block bg-yellow-300 text-gray-900 font-semibold px-6 py-3 rounded-lg hover:bg-yellow-400 transition">Upgrade Now</a>
      </section>

      {{-- Materials Showcase --}}
      <section class="mb-12">
        <h2 class="text-2xl font-semibold text-yellow-300 mb-6 text-center">Tons of Marketing Materials</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
          <div class="bg-gray-800 p-4 rounded-lg text-center">
            <span class="block text-3xl mb-2">📑</span>
            <span class="text-gray-300">Splash Pages</span>
          </div>
          <div class="bg-gray-800 p-4 rounded-lg text-center">
            <span class="block text-3xl mb-2">✉️</span>
            <span class="text-gray-300">Email Copy</span>
          </div>
          <div class="bg-gray-800 p-4 rounded-lg text-center">
            <span class="block text-3xl mb-2">🖼️</span>
            <span class="text-gray-300">Banner Ads</span>
          </div>
          <div class="bg-gray-800 p-4 rounded-lg text-center">
            <span class="block text-3xl mb-2">📱</span>
            <span class="text-gray-300">Social Posts</span>
          </div>
        </div>
      </section>

      {{-- Final Encouragement --}}
      <section class="bg-gray-900 p-8 rounded-2xl shadow-inner text-center">
        <h3 class="text-xl font-semibold text-yellow-300 mb-3">Ready to Start Earning?</h3>
        <p class="text-gray-400 mb-6">Sign up, share your unique link, and watch your earnings grow. There’s never been a better time!</p>
        <a href="{{ url('/affiliate/registration') }}" class="inline-block bg-yellow-300 text-gray-900 font-semibold px-6 py-3 rounded-lg hover:bg-yellow-400 transition">Join the Program</a>
      </section>

    </div>
  </div>
</x-app-layout>
