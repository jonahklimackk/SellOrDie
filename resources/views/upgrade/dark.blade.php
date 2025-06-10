<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upgrade to Heavyweight</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
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
        <p class="text-lg leading-relaxed">If you're a serious affiliate, agency, or entrepreneur looking to dominate the marketing battlefield, Heavyweight Status gives you the tools, exposure, and credibility to rise above the rest.</p>
      </div>
    </div>

    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4 text-yellow-300">💸 Choose Your Plan</h2>
      <p class="text-lg mb-6">Only <strong>$27/month</strong> or <strong>$197/year</strong> (4 months free!)</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="https://buy.stripe.com/4gMeVdaJ7bv6cND5zG6kg00"><button class="px-6 py-3 bg-yellow-400 text-black font-semibold rounded-xl shadow hover:bg-yellow-300 transition">Subscribe Monthly – $27/mo</button></a>
        <a href="https://buy.stripe.com/28EfZh7wVczadRH0fm6kg01">
        <button class="px-6 py-3 bg-yellow-500 text-black font-semibold rounded-xl shadow hover:bg-yellow-400 transition">Subscribe Yearly – $197/yr</button></a>
      </div>
    </div>

    <div class="mb-12">
      <h2 class="text-3xl font-bold text-center text-yellow-300 mb-6">📊 Free vs Heavyweight Comparison</h2>
      <canvas id="comparisonChart" class="max-w-2xl mx-auto"></canvas>
    </div>

    <div class="bg-gray-800 p-6 rounded-2xl shadow-xl max-w-3xl mx-auto">
      <h2 class="text-2xl font-bold text-yellow-300 mb-4">🏆 Real Results</h2>
      <blockquote class="italic border-l-4 border-yellow-400 pl-4 mb-4">“Once I went Heavyweight, my ad visibility tripled. I got over 500% more votes and doubled my conversions.” – Jenna M.</blockquote>
      <blockquote class="italic border-l-4 border-yellow-400 pl-4">“This isn’t some ‘traffic exchange.’ This is <strong>marketing war</strong>. And when you’re a Heavyweight, you win sales.” – Luis R.</blockquote>
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
      }).then(function (result) {
        if (result.error) {
          alert(result.error.message);
        }
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
          y: {
            beginAtZero: true,
            max: 5,
            ticks: {
              color: '#d1d5db'
            },
            grid: {
              color: '#374151'
            }
          },
          x: {
            ticks: {
              color: '#d1d5db'
            },
            grid: {
              color: '#374151'
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              color: '#fff'
            }
          }
        }
      }
    });
  </script>
</body>
</html>