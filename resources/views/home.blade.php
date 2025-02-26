
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

<h1 class="mt-2  text-4xl font-medium text-gray-900 dark:text-white">
                    
                    Welcome {{ Auth::user()->name }}!
                </h1>
<p>
                    You have {{ $credits }} credits
                </p>
                <p>   Your status is status </p>
<p>
                    Judge some fights
                </p>

                   <p> Upgrade now and get 5000 credits / month </p>

                    <p>1 credit = 1 ad view</p>

                    <p>Every fight you judge you get between 3 and 10 credits</p>

                    <p>

                   Jump into the fray, add your advertisement to the system and start gettingg visitors to your website</p>

                   <p> Remember, this is taragetted traffic, here's ain interesting bit of psychology when somebody has to pick betwen 2 cvhoices, he later identifies with that choice nad will stick to it no matter wat. B
                    y clicking on an ad, you chose thatwebsite, adn you will be that much more recceptive when you get to the website </p>

                  

                  <p>  Here are your ads</p>


                    @foreach ($data as $key => $item)
<div align="center">
                    <div class="mt-20 flex justify-between">
                        <div>
                           <h1> {{ $data[$key]['fight']->name }} </h1>


                            <div class="mt-2 px-4 py-4 grid lg:grid-cols-3 bg-indigo-400 rounded-md font-semibold">


                             <div> Fights: </div> <div></div><div> {{ App\Models\FightViewLog::getViews($data[$key]['fight']->id)  ?? 0}}</div>
                             @if(isset($data[$key]['opponentsAd']))
                             <div> {{ $data[$key]['opponentsAd']->user->name ?? '' }}'s Clicks:</div> 
                             <div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0}}</div>
                             @else
                             <div>Opponent's Clicks:</div> <div></div><div>{{ $data[$key]['opponentsClicks'] ?? 0 }}</div>
                             @endif
                             <div> Your Clicks: </div><div></div> <div> {{ $data[$key]['clicks'] ?? 0}}</div> 
                             <div> Your Record: </div> <div></div><div> {{ $data[$key]['clicks'] ?? 0}} - {{ $data[$key]['opponentsClicks'] ?? 0 }} - {{ $data[$key]['draws'] ?? 0 }}</div>
                             <div> Win Percentage</div><div></div><div>{{ $data[$key]['winLoss'] ?? 0}}%</div>
                             @if (Auth::user()->currentTeam->status == 'live')
                             <div>Daily Ranking: </div> <div></div><div>{{ $data[$key]['ranking'] ?? ''}} place</div>
                             @else
                             <div>Daily Ranking: </div> <div></div><div> n/a </div>
                             @endif
                             <div> Status:</div><div></div><div>{{ Auth::user()->currentTeam->status }}</div>
                             <div></div>  
                         </div> 
                     </div>
                 </div>
             </div>
                 @endforeach


             </div>
         </div>
     </div>
 </x-app-layout>