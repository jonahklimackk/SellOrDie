
<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
          <div class="flex">
            <div class="description">
              <h1 class="mt-2  text-4xl font-medium text-gray-900 dark:text-white">Your SellorDie Affiliate Stats</h1>
              <div class="mt-5">
                We make promoting SellorDie as easy and as effective as possible by tracking your ads for you!
              </div>
              <div class="mt-5">
                This feature allows you to track all the clicks you receive to your affiliate links.
              </div>
              <div class="mt-5 font-semibold">
                Here is how it works:
              </div>
              <div class="mt-5">
                For every marketing campaign you are doing with your SellorDie affiliate link, you can customize the link so that we can track it sepately for you.  As an example, lets say you are sending and ad out at a list builder, then you can use a link like this:
              </div>
              <div class="mt-5">
                <a href="/aff/{{ Auth::user()->username }}/listbuilderad"><b>http://SellorDie.online/aff/{{ Auth::user()->username }}/listbuilderad</b></a>
              </div>
              <div class="mt-5">
                And if you are promoting on a traffic exchange, you can use a link like this:
              </div>
              <div class="mt-5">
                <a href="/aff/{{ Auth::user()->username }}/trafficexchangead"><b>http://SellorDie.online/aff/{{ Auth::user()->username }}/trafficexchangead</b></a>
              </div>
              <div class="mt-5">
                All you do is add ‘listbuilderad’ or anything you want at the end of your affiliate link, and we’ll do the rest!
              </div>
              <div class="mt-5">
                Then, all the clicks, joins, and confirmed members that come through those links will be tracked and the results will be displayed below. That way you will know which ad is working and which one isn’t.
              </div>
            </div>
            <div>


<div class="mt-2 px-4 py-4  bg-indigo-400 rounded-md font-semibold">
            <table class="mt-5">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Track code</th>
                  <th>Clicks</th>
                  <th>Joins</th>
                  <th>Sales</th>
                </tr>
              </thead>
              <tbody>

                @if(isset($campaigns))
                @foreach($campaigns as $campaign)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $campaign->value }}</td>
                  <td>{{ $campaign->raw }}</td>
                  <td>{{ $campaign->joins }}</td>
                  <td>{{ $campaign->sales }}</td>
                </tr>
                @endforeach
                @endif

              </tbody>
            </table>             
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>