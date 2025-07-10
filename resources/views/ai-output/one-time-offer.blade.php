<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Mother of All One-Time Offers | Sell Or Die</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700&display=swap" rel="stylesheet" />
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .font-inter { font-family: 'Inter', sans-serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
  </style>
</head>
<body class="bg-[#1f1c27] text-white font-inter">
  <!-- Hero Section -->
  <section class="text-center py-20 px-4">
<!--     <h1 class="font-montserrat text-5xl md:text-6xl text-red-600 mb-4">
      The <span class="text-yellow-400">Mother</span> of All <span class="line-through">One-Time</span> Offers
    </h1> -->
<div align="center">
    <img src="/img/oto4.png" width='500' height='500'>
  </div>
    <!-- VS Image -->
    <!-- <img src="/images/vs-image.png" alt="VS" class="mx-auto w-2/3 max-w-sm mb-8" /> -->
    <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-300">
      Unlock <span class="font-montserrat font-semibold">Heavyweight</span> for just 
      <span class="text-red-500 font-bold">$197/year</span>—the one-time upgrade that levels up your ad game forever.
    </p>
    <a href="#" class="mt-8 inline-block bg-red-600 hover:bg-red-700 text-white font-bold uppercase tracking-wide py-4 px-8 rounded-full shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
      Upgrade Now
    </a>
  </section>


@php
  $bonuses = [
    [
      'title'       => 'Done-For-You Ad Template Pack',
      'description' => '10–15 pre-built HTML ad templates (Tailwind-ready) you can drop right into your campaigns.',
      'iconSrc'     => asset('images/icons/template-pack.svg'),
      'imageSrc'    => asset('images/bonuses/template-pack.jpg'),
    ],
    [
      'title'       => 'Swipe-File of Top-Performing Ad Copy',
      'description' => 'Curated headlines, subheads & CTAs with “fill-in-the-blank” prompts so you write winning copy in minutes.',
      'iconSrc'     => asset('images/icons/swipe-file.svg'),
      'imageSrc'    => asset('images/bonuses/swipe-file.jpg'),
    ],
    [
      'title'       => 'Video Crash-Course: From Zero to Hero Ad Weapon',
      'description' => 'A 60-minute screencast showing step-by-step how to build, launch & A/B test your ads in Sell Or Die.',
      'iconSrc'     => asset('images/icons/video-course.svg'),
      'imageSrc'    => asset('images/bonuses/video-course.jpg'),
    ],
    [
      'title'       => 'Ad Audit & Feedback Session',
      'description' => 'A 30-minute one-on-one Zoom call where we review your ad, suggest improvements & unlock quick wins.',
      'iconSrc'     => asset('images/icons/feedback.svg'),
      'imageSrc'    => asset('images/bonuses/feedback.jpg'),
    ],
    [
      'title'       => 'Conversion-Boosting Swipe File: Irresistible Offers',
      'description' => '20 proven upsell, downsell & cross-sell templates you can plug right into your funnels.',
      'iconSrc'     => asset('images/icons/bolt.svg'),
      'imageSrc'    => asset('images/bonuses/irresistible-offers.jpg'),
    ],
    [
      'title'       => 'High-Impact Graphics Asset Bundle',
      'description' => '100+ royalty-free SVG/PNG icons, backgrounds & headers sized for all Sell Or Die slots (468×60, 300×250, etc.).',
      'iconSrc'     => asset('images/icons/graphics.svg'),
      'imageSrc'    => asset('images/bonuses/graphics-bundle.jpg'),
    ],
    [
      'title'       => '“Ad Weapon” AI Credit Booster',
      'description' => '5,000 extra AI-generation credits (25 heavyweight ad weapons) so you never hit your limits.',
      'iconSrc'     => asset('images/icons/rocket.svg'),
      'imageSrc'    => asset('images/bonuses/ai-booster.jpg'),
    ],
    [
      'title'       => 'Quick-Start Checklist & Swipe-Sheet',
      'description' => 'A laminated PDF checklist walking you through setup, launch & optimization—plus a fillable results sheet.',
      'iconSrc'     => asset('images/icons/clipboard.svg'),
      'imageSrc'    => asset('images/bonuses/checklist.jpg'),
    ],
    [
      'title'       => 'Private Mastermind Community Access',
      'description' => '30 days in an exclusive Slack/Discord with other power users and Sell Or Die insiders.',
      'iconSrc'     => asset('images/icons/users.svg'),
      'imageSrc'    => asset('images/bonuses/community.jpg'),
    ],
    [
      'title'       => 'Monthly “Inside the Funnel” Case Study',
      'description' => 'Real-world breakdown of a top member’s campaign: ad weapon, budgets, results & tweaks.',
      'iconSrc'     => asset('images/icons/chart-bar.svg'),
      'imageSrc'    => asset('images/bonuses/case-study.jpg'),
    ],
    [
      'title'       => 'Copywriting Mini-Workbook',
      'description' => 'Fill-in-the-blank templates for bullets, guarantees & scarcity triggers—with top-grossing examples.',
      'iconSrc'     => asset('images/icons/book.svg'),
      'imageSrc'    => asset('images/bonuses/workbook.jpg'),
    ],
    [
      'title'       => 'Lifetime Discount on Future Add-Ons',
      'description' => 'A 20% off coupon for any future upgrades—advanced reporting, premium analytics or voice-overs.',
      'iconSrc'     => asset('images/icons/tag.svg'),
      'imageSrc'    => asset('images/bonuses/discount.jpg'),
    ],
  ];
@endphp

@foreach($bonuses as $bonus)
  <x-bonus-hero
    :title="$bonus['title']"
    :description="$bonus['description']"
    :iconSrc="$bonus['iconSrc']"
    :imageSrc="$bonus['imageSrc']"
  />
@endforeach




  <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow-lg">
  <thead class="bg-gray-800">
    <tr>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Feature</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Amateur</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Lightweight</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Heavyweight</th>
      <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Benefit</th>
    </tr>
  </thead>
  <tbody class="bg-[#1f1c27] divide-y divide-gray-700">
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">ad weapon</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">text only</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">full html wysiwyg</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">ai generated ads</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        capture the voters eye with a beautiful, rich, full html ad... it will automatically generate an ad weapon for you
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">cost to display ad weapon</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">50</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">30</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">20</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        it lasts forever when you pay less for displaying your fights
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">credits for voting</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">20-60</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">25-75</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">30-90</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        your fight displayed 1.5 to 2 more times with paid membership
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">Max # of fights</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">3</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">5</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">unlimited</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        multiple fights for all of your programs, multi-way advertising
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">login ads?</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        login ads work, but you have to be heavyweight to get it
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">banner ad on surf page</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        let the voters/visitors focus on your ad weapons
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">priority support</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        get replies to your inquiries within hours
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">bonus credits</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">0</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">50</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">100</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        set it on autopilot—bonus credits delivered to your site every day
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">in random opponent your ads get picked:</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">third</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">second</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">first</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        get your ads seen in priority, paid members first!
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">test ads by running fights with 2 of your ads</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        know which of your ads work and roll out the winners
      </td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-white">pick only free members as opponents – free, ugly ad, easy win</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">no</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">yes</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
        so you can get the easy win and all the traffic and sales
      </td>
    </tr>
  </tbody>
</table>


  <!-- Benefits Section -->
  <section class="bg-gray-800 py-16 px-4">
    <div class="max-w-4xl mx-auto">
      <h2 class="font-montserrat text-3xl text-yellow-400 mb-8 text-center">What You Get with Heavyweight</h2>
      <div class="grid gap-8 md:grid-cols-2">
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">🔥</div>
          <div>
            <h3 class="font-semibold text-xl">Unlimited Ad Battles</h3>
            <p class="text-gray-400">Challenge any competitor, any time—no limits.</p>
          </div>
        </div>
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">📊</div>
          <div>
            <h3 class="font-semibold text-xl">Advanced Analytics Dashboard</h3>
            <p class="text-gray-400">Real-time conversion tracking, heatmaps, and deep-dive reports.</p>
          </div>
        </div>
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">🎨</div>
          <div>
            <h3 class="font-semibold text-xl">Premium Fighter Card Templates</h3>
            <p class="text-gray-400">10 new HTML/Tailwind layouts with custom SVG icons.</p>
          </div>
        </div>
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">🎯</div>
          <div>
            <h3 class="font-semibold text-xl">Targeting Mastery Suite</h3>
            <p class="text-gray-400">Geo-, demo-, and interest-based filters to laser-focus campaigns.</p>
          </div>
        </div>
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">⚡</div>
          <div>
            <h3 class="font-semibold text-xl">Priority Support</h3>
            <p class="text-gray-400">Skip the queue—expert help within 1 hour.</p>
          </div>
        </div>
        <div class="flex items-start">
          <div class="mr-4 text-red-500 text-3xl">📚</div>
          <div>
            <h3 class="font-semibold text-xl">Member-Only Resource Library</h3>
            <p class="text-gray-400">Video tutorials, case studies, and swipe files.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bonus Stack -->
  <section class="py-16 px-4">
    <div class="max-w-4xl mx-auto">
      <h2 class="font-montserrat text-3xl text-yellow-400 mb-8 text-center">💥 Bonus Stack <span class="text-gray-400 text-base">(Valued at $1,512)</span></h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto text-gray-200">
          <thead>
            <tr class="border-b border-gray-700">
              <th class="px-4 py-2 text-left">Bonus</th>
              <th class="px-4 py-2 text-right">Value</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Marketing Strategy Audit</td>
              <td class="px-4 py-2 text-right">$297</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Personalized Ad Copy Generator</td>
              <td class="px-4 py-2 text-right">$197</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">“Succeed on a Shoestring” Masterclass</td>
              <td class="px-4 py-2 text-right">$147</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Monthly Live Q&A with Experts</td>
              <td class="px-4 py-2 text-right">$97</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Ad Review Service (5 ads/mo.)</td>
              <td class="px-4 py-2 text-right">$247</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Private Community Access</td>
              <td class="px-4 py-2 text-right">$97</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="px-4 py-2">Template Vault (50+ swipe files)</td>
              <td class="px-4 py-2 text-right">$127</td>
            </tr>
            <tr>
              <td class="px-4 py-2">Fast-Action 1:1 Strategy Call</td>
              <td class="px-4 py-2 text-right">$300</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p class="mt-4 text-center text-gray-300">You’re getting $1,512 worth of bonuses…for just <span class="text-red-500 font-semibold">$197/year</span>!</p>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="bg-gray-800 py-16 px-4">
    <div class="max-w-3xl mx-auto space-y-8">
      <h2 class="font-montserrat text-3xl text-yellow-400 text-center">What Our Members Are Saying</h2>
      <div class="space-y-6">
        <blockquote class="border-l-4 border-yellow-400 pl-4 italic text-gray-300">
          “I unlocked the Audit bonus and within a week doubled my conversion rate.”
          <footer class="mt-2 text-sm text-gray-500">— Emily R., e-Commerce Founder</footer>
        </blockquote>
        <blockquote class="border-l-4 border-yellow-400 pl-4 italic text-gray-300">
          “The Ad Copy Generator is a game-changer— it writes headlines that actually convert. Totally worth the upgrade!”
          <footer class="mt-2 text-sm text-gray-500">— Carlos M., Agency Owner</footer>
        </blockquote>
        <blockquote class="border-l-4 border-yellow-400 pl-4 italic text-gray-300">
          “Investing $197/year blew my mind— the ROI on just one campaign covered my membership for two years!”
          <footer class="mt-2 text-sm text-gray-500">— Dana S., Affiliate Marketer</footer>
        </blockquote>
      </div>
    </div>
  </section>

  <!-- Final CTA -->
  <section class="text-center py-16 px-4">
    <h2 class="font-montserrat text-4xl text-red-600 mb-6">Ready to Dominate?</h2>
    <a href="#" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold uppercase tracking-wide py-4 px-8 rounded-full shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
      Yes! Upgrade Me to Heavyweight
    </a>
    <p class="mt-4 text-gray-400">One-time offer – never coming back.</p>
  </section>
</body>
</html>