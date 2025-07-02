<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Or Die — Ad Battles Made Epic</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom colors */
    .bg-sod-dark { background-color: #1f1c27; }
    .text-sod-yellow { color: #FBBF24; }
    .bg-sod-yellow { background-color: #FBBF24; }
  </style>
</head>
<body class="antialiased bg-sod-dark text-white">

  <!-- Hero -->
  <section 
  onclick='window.location.href="/aff/{{ $username }}/{{ $campaign ?? '' }}"'
  class="min-h-screen flex flex-col justify-center items-center text-center px-6"
  style="cursor: pointer;">
  <h1 class="text-5xl md:text-6xl font-bold text-sod-yellow mb-6">
    Enter the Ring of Ad Battles
  </h1>
  <p class="max-w-2xl text-lg md:text-xl mb-8">
    Sell Or Die is the first-ever ad-voting exchange. Pit your creative against real competitors, climb the leaderboard, and win real traffic—and credits—every single day.
  </p>
  <a href="/aff/{{ $username }}/{{ $campaign ?? '' }}"
  class="inline-block bg-sod-yellow text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:brightness-110 transition">
  Join the Fight & Get 500 Free Credits
</a>
</section>

<!-- Features -->
<!--   <section class="py-20 px-6">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
      <div class="text-center">
        <svg class="w-12 h-12 mx-auto mb-4 text-sod-yellow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 18l10-5..."/></svg>
        <h3 class="text-2xl font-bold mb-2">Real-Time Voting</h3>
        <p>Every vote drives your ad up the leaderboard. Engage thousands to cast real feedback.</p>
      </div>
      <div class="text-center">
        <svg class="w-12 h-12 mx-auto mb-4 text-sod-yellow" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
        <h3 class="text-2xl font-bold mb-2">High Conversion</h3>
        <p>Our platform breeds trust—ads here convert at rates 3× higher than standard networks.</p>
      </div>
      <div class="text-center">
        <svg class="w-12 h-12 mx-auto mb-4 text-sod-yellow" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/></svg>
        <h3 class="text-2xl font-bold mb-2">Earn Credits</h3>
        <p>Win credits for each vote you cast or ad you submit—never surf for nothing again.</p>
      </div>
    </div>
  </section> -->

  <!-- How It Works -->
<!--   <section class="bg-gray-800 py-20 px-6">
    <div class="max-w-4xl mx-auto space-y-8 text-center">
      <h2 class="text-4xl font-bold text-sod-yellow">How It Works</h2>
      <ol class="list-decimal list-inside space-y-4 text-lg">
        <li>Submit your HTML ad or choose from our weapon generator.</li>
        <li>Ads battle head-to-head—viewers vote for the winner.</li>
        <li>Your winner climbs the daily leaderboard for viral exposure.</li>
        <li>Earn credits and insights to power endless new campaigns.</li>
      </ol>
    </div>
  </section> -->

  <!-- Footer CTA -->
<!--   <footer class="py-12 text-center">
    <a href="{{ url('/signup') }}"
       class="bg-sod-yellow text-gray-900 font-semibold px-10 py-4 rounded-full shadow-xl hover:scale-105 transform transition">
      Start Your First Battle & Score Free Credits
    </a>
  </footer> -->

</body>
</html>
