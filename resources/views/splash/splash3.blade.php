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
<body class="antialiased bg-sod-dark text-white" >

  <!-- Above-the-Fold Hero -->
  
  <section 
  onclick='window.location.href="/aff/{{ $username }}/{{ $campaign ?? '' }}"'
  class="min-h-screen flex flex-col justify-center items-center text-center px-6"
  style="cursor: pointer;">
    <!-- Logo -->
    <img src="https://sellordie.online/img/sellordie7.png"
         alt="Sell Or Die Logo"
         class="w-48 mb-8">

    <!-- Headline -->
    <h1 class="text-4xl md:text-5xl font-bold text-sod-yellow mb-4">
      Can Your Ad Compete Against Your Friend?
    </h1>

    <!-- Sub-line -->
    <p class="text-lg md:text-xl mb-8 max-w-lg">
      Join the only 1:1 ad-voting exchange. Challenge friends, vote head-to-head—and earn dozens of credits per vote.  
      No fluff, no gimmicks—just real rewards and fun voting.
    </p>

    <!-- Call to Action -->
    <a href="/aff/{{ $username }}/{{ $campaign ?? '' }}"
       class="inline-block bg-sod-yellow text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transform transition">
      Start the Challenge & Earn Credits
    </a>
  </section>

</body>
</html>
