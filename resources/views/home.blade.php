
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white   border-b border-gray-200 ">

                    <h1 class="mt-2  text-4xl font-medium text-gray-900">

                        Welcome {{ Auth::user()->name }}!
                    </h1>


                    <p>&nbsp;</p>
                    <div class="grid lg:grid-cols-2">
                        <div class="flex">
                        <p>
                            <b> You have {{ $credits }} credits</b></p>
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                          <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525"/>
                      </svg>
                  </div>


                  <p> Your status is status </p>
                  <p>
                    <a href="/fights" class="inline-flex items-center font-semibold text-[#04cef6]">Judge some fights to earn more credits</a>
                </p>

                <p> <a href="/upgrade" class="inline-flex items-center font-semibold text-[#04cef6]">Upgrade now and get 5000 credits / month </a></p>


            </div>

            <p>Every fight you judge you get between 3 and 10 credits</p>
            <br>

            <p>

                Jump into the fray, <a href="/teams/create" class="inline-flex items-center font-semibold text-[#04cef6]">create a new fight</a> and start getting visitors to your website immediately.</p>
                <br>

<!--                     <p> Remember, this is taragetted traffic, here's ain interesting bit of psychology when somebody has to pick betwen 2 cvhoices, he later identifies with that choice nad will stick to it no matter wat. B
y clicking on an ad, you chose thatwebsite, adn you will be that much more recceptive when you get to the website </p> -->



<p>  Here are your fights click to configure them.</p>
<br><br><br>


<div align="center">

    <div class="grid grid-cols-2 gap-4">
        @foreach ($data as $key => $item)

        <form method="POST" action="{{ route('current-team.update') }}" x-data>
            @method('PUT')
            @csrf

            <!-- Hidden Team ID -->
            <input type="hidden" name="team_id" value="{{ $data[$key]['fight']->id }}">


            <a href="#" x-on:click.prevent="$root.submit();">


               <div class="text-5xl" style="height:100px; overflow:clip;">{{ $data[$key]['fight']->name }}</div>
               <!-- <div class="text-5xl line-clamp-2" >{{ $data[$key]['fight']->name }}</div> -->




               <div class="mt-2 px-4 py-4 grid lg:grid-cols-3 bg-[#04cef6] rounded-md font-semibold">
                   <div> Fights: </div> <div></div><div> {{ App\Models\FightViewLog::getViews($data[$key]['fight']->id,'all')  ?? 0}}</div>
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
                   <div> Status:</div><div></div><div>{{ $data[$key]['status'] }}</div>
                   <div></div>  
               </div> 
           </a>
       </form>


       @endforeach
   </div>

</div>
</div>
</div>
</div>
</div>
</x-app-layout>