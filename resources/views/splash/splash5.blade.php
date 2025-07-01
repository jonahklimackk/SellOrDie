<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Or Die — Earn $100 Per Sale!</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Match logo background */
    .bg-sod-dark { background-color: #1F2937; }
    .text-sod-yellow { color: #FBBF24; }
    .bg-sod-yellow { background-color: #FBBF24; }
  </style>
</head>
<body class="antialiased bg-sod-dark text-white">

  <!-- Above-the-Fold Hero -->
  <section class="min-h-screen flex flex-col justify-center items-center text-center px-6">
    <!-- Logo -->
    <img src="https://sellordie.online/img/sellordie7.png"
         alt="Sell Or Die Logo"
         class="w-48 mb-6">

    <!-- Headline -->
    <h1 class="text-4xl md:text-5xl font-bold text-sod-yellow mb-4">
      Earn $100 Every Time You Refer a Sale!
    </h1>

    <!-- Sub-line -->
    <p class="text-lg md:text-xl mb-8 max-w-lg">
      Join Sell Or Die’s affiliate program—the hottest ad-voting exchange online—and get paid $100 for each one-time offer you sell.  
      It’s simple: share your link, drive sales, and pocket big commissions.
    </p>

    <!-- Call to Action -->
    <a href="{{ url('/aff/'.auth()->user()->username) }}"
       class="inline-block bg-sod-yellow text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transform transition">
      Become an Affiliate & Start Earning
    </a>
  </section>

</body>
</html>
