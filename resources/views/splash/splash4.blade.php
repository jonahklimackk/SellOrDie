<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Or Die — Can Your Ad Compete?</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Match logo background */
    .bg-sod-dark { background-color: #1F2937; }
    .text-sod-yellow { color: #FBBF24; }
    .bg-sod-yellow { background-color: #FBBF24; }
  </style>
</head>
<body class="antialiased bg-sod-dark text-white">

  <!-- Hero -->
  <section class="pt-20 pb-12 text-center px-6">
    <img src="https://sellordie.online/img/sellordie7.png"
         alt="Sell Or Die Logo"
         class="w-40 mx-auto mb-6">

    <h1 class="text-4xl md:text-5xl font-bold text-sod-yellow mb-4">
      Can Your Ad Compete? Is Your Ad Weak?
    </h1>
    <p class="text-lg md:text-xl mb-8 max-w-xl mx-auto">
      Launch your best ad into the ring—and see who comes out on top.  
      Every click, every vote earns you credits in our 1:1 exchange.  
      No fluff, no guesswork—just real marketing feedback.
    </p>
    <a href="{{ url('/signup') }}"
       class="inline-block bg-sod-yellow text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transform transition">
      Start Your First Battle
    </a>
  </section>

  <!-- Template Previews -->
<!--   <section class="py-12 px-6">
    <h2 class="text-2xl font-bold text-center text-sod-yellow mb-8">Pick Your Template</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
      <!-- Repeat for each splash template -->
<!--       <div class="overflow-hidden rounded-lg border border-gray-700 shadow-lg">
        <a href="{{ url('/splash/id/1') }}">
          <img src="https://sellordie.online/upload/splashes/Splash_001.png"
               alt="Splash Template 1"
               class="w-full object-cover">
        </a>
      </div>
      <div class="overflow-hidden rounded-lg border border-gray-700 shadow-lg">
        <a href="{{ url('/splash/id/2') }}">
          <img src="https://sellordie.online/upload/splashes/Splash_002.png"
               alt="Splash Template 2"
               class="w-full object-cover">
        </a>
      </div>
      <div class="overflow-hidden rounded-lg border border-gray-700 shadow-lg">
        <a href="{{ url('/splash/id/3') }}">
          <img src="https://sellordie.online/upload/splashes/Splash_003.png"
               alt="Splash Template 3"
               class="w-full object-cover">
        </a>
      </div>
      <div class="overflow-hidden rounded-lg border border-gray-700 shadow-lg">
        <a href="{{ url('/splash/id/4') }}">
          <img src="https://sellordie.online/upload/splashes/Splash_004.png"
               alt="Splash Template 4"
               class="w-full object-cover">
        </a>
      </div>
      <div class="overflow-hidden rounded-lg border border-gray-700 shadow-lg">
        <a href="{{ url('/splash/id/5') }}">
          <img src="https://sellordie.online/upload/splashes/Splash_005.png"
               alt="Splash Template 5"
               class="w-full object-cover">
        </a>
      </div>
    </div>
  </section> -->

  <!-- Footer CTA -->
<!--   <footer class="py-12 text-center">
    <a href="{{ url('/signup') }}"
       class="bg-sod-yellow text-gray-900 font-semibold px-10 py-4 rounded-full shadow-xl hover:brightness-110 transition">
      Launch Your Ad & Earn Credits Now
    </a>
  </footer> -->

</body>
</html>
