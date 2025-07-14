<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Or Die – Login Splash</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1f1c27] min-h-screen flex items-center justify-center px-4">
  <div 
    class="relative text-center max-w-xl p-8 bg-gray-800 rounded-xl
           ring-4 ring-yellow-300 ring-opacity-75 ring-offset-4 ring-offset-[#1f1c27]
           shadow-2xl shadow-yellow-500/50
           animate-pulse"
  >
    <!-- Glowing yellow radial gradient behind the ring -->
    <div class="absolute inset-0 rounded-xl bg-yellow-300 opacity-10 blur-3xl"></div>
    
    <!-- Content -->
    <div class="relative">
      <!-- Headline -->
      <h1 class="text-5xl md:text-6xl font-bold text-yellow-300 mb-6 drop-shadow-lg">
        Put Your Login Ad Here
      </h1>

      <!-- Ad Body -->
      <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed drop-shadow-md">
        Login ads really work well, it is an expensive form of website real estate and only heavyweights can place them.
        Just imagine how many products you'll sell when your prospects look at this beautiful ad. Or if you want,
        have AI create the ad for you, that's also a perk to a heavyweight membership.
      </p>

      <!-- Call to Action Button -->
      <a 
        href="/register"
        class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-8 rounded-full 
               shadow-lg shadow-red-600/50 transition-transform transform hover:scale-105"
      >
        Join the Fight →
      </a>
    </div>
  </div>
</body>
</html>
