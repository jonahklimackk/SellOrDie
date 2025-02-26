
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">



                  <h1 class="mt-2  text-4xl font-medium text-gray-900 dark:text-white">
                    Official SellorDie League Rankings For {{ $humanPeriod }}
                </h1>
                <p>&nbsp</p>

                <p>have different stats for different member status (lightweigjtl  bantam wegith etc)</p>


                <a href="/league/today"><x-green-button>Today</x-green-button></a>
                <a href="/league/yesterday"><x-green-button>Yesterday</x-green-button></a>
                <a href="/league/thisweek"><x-green-button>This Week</x-green-button></a>
                <a href="/league/lastweek"> <x-green-button>Last Week</x-green-button></a>
                <a href="/league/thismonth"> <x-green-button>This Month</x-green-button></a>
                <a href="/league/lastmonth">   <x-green-button>Last Month</x-green-button></a>

<p>&nbsp;</p>


                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Rank</th>
                            <th class="py-3 px-6 text-left">Fight Name</th>
                            <th class="py-3 px-6 text-left">Fighter</th>
                            <th class="py-3 px-6 text-left">Opponent</th>
                            <th class="py-3 px-6 text-left">Fight Ad Headline</th>
                            <th class="py-3 px-6 text-left">Fight Opponent Ad Headline</th>
                            <th class="py-3 px-6 text-left">Fights</th>
                            <th class="py-3 px-6 text-left">Wins</th>
                            <th class="py-3 px-6 text-left">Losses</th>
                            <th class="py-3 px-6 text-left">Win/Loss Percentage</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
<!--                         <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">1</td>
                            <td class="py-3 px-6">John Doe</td>
                            <td class="py-3 px-6">john@example.com</td>
                            <td class="py-3 px-6">Admin</td>
                            <td class="py-3 px-6">IT</td>
                            <td class="py-3 px-6">123-456-7890</td>
                            <td class="py-3 px-6">New York</td>
                            <td class="py-3 px-6">Active</td>
                            <td class="py-3 px-6">2021-05-10</td>
                                                        <td class="py-3 px-6">Active</td>
                            <td class="py-3 px-6">2021-05-10</td>
                        </tr> -->
                        @foreach($fights as $fight)
                        <tr>
                            <td align="center"> {{ $loop->index+1 }}
                                <td align="center">

                                    <a href="/fights/show/{{ $fight->id }}" target="_new">
                                        <x-green-button>{{ $fight->name }}</x-green-button>
                                    </a>

                                </td>
                                <td align="center">{{ $fight->fightOwner->name }}</td>
                                <!-- <td align="center">{{ $fight->fightOwner->email }}</td> -->
                                <td align="center">

                                    {{ $fight->opponent->name ?? ''}}

                                </td>
                                <!-- <td align="center">{{ $fight->opponent->email ?? ''}}</td>                             -->
                                <td align="center">{{ $fight->ad->headline ?? ''}}</td>
                                <td align="center">{{ $fight->opponentsAd->headline ?? '' }}</td>
                                <td align="center">{{ $fight->views }}</td>
                                <td align="center">{{ $fight->clicks }}</td>
                                <td align="center">{{ $fight->opponentsClicks }}</td>
                                <td align="center">{{ number_format($fight->winLoss*100,2) }}%</td>
   <!--                      <td align="center">{{ $fight->type }}</td>
                        @if ($fight->type == 'open')
                        <td align="center"><a href="">Join</a></td>
                        @else
                        <td align="center">&nbsp;</td>
                        @endif -->
                    </tr>
                    @endforeach                        
                </tbody>
            </table>






            <div class="mt-20">












                <p>

                    Daily Rankoings
                    msot e3ffect ad of the hours
                    who has the most effective ad today?
                    this week?
                    this month?
                    this year?
                    all time?
                    so now thesre' incentive for peooe
                    b/c  they'll get feeatured at the top10
                </p>

                <p>


                    <b>
                        people want to know, which ad sells the best
                        that's the popint of this sitre
                    find your winner ad  and then roll out withit </b>
                </p>


                <br>
            best performing ad </br>
            best performing fighter 
            <br>
            Daily Contests<br>
            Weekly Contest <br>
            Who has the  better aed
            sell or die .online
            do you have rthe courage to pit your best ad amongs the very best aed fighters in the leauge?
            invite your friends, see who has the better program, better ocnvresion rate

            here's the thing, when somone is given an option, and then choose that optino, they will act
            afterwards in congruency with thischoice, and so if they pick your ad, and the windows pops
            up to click again they are in effect targeted
            Foot in the door dconcept
            putting signs on your lawn concept
            I think tha'ts fro mscientifidc advertising

            edownload sci ad to your phone
        </div>


    </div>

</div>
</div>
</x-app-layout>



