


<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">


Choose which aed to use

put preview on here that sswitdchfes when they pick qwhic had

free members only get 1 ad?

<?php
dd($ads);
?>

<ul>
    @foreach($ads as $ad)
    <li><a href="{{ $ad->url }}"> {{ $ad->subject }} </a></li>
    @endforeach
</ul>



</div>


