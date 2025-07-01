<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Or Die — Earn Credits by Voting</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-sod-dark { background-color: #1f1c27; }
    .text-sod-yellow { color: #FBBF24; }
    .bg-sod-yellow { background-color: #FBBF24; }
  </style>
</head>
<body class="antialiased bg-sod-dark text-white">

  <!-- Above-the-Fold Hero -->
  <section class="min-h-screen flex flex-col justify-center items-center text-center px-6">
    <h1 class="text-4xl md:text-5xl font-bold text-sod-yellow mb-4">
      Surf Ads. Cast Votes. Earn Credits.
    </h1>
    <p class="text-lg md:text-xl mb-8 max-w-xl">
      Join the only 1:1 ad-voting exchange—every vote you cast gives you one credit.  
      No fluff, no gimmicks, just real rewards for your time.
    </p>
    <a href="{{ url('/signup') }}"
       class="inline-block bg-sod-yellow text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transform transition">
      Start Voting & Earning
    </a>
  </section>

</body>
</html>
