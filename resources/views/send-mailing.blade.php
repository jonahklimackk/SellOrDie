<!-- {{ session('showCreateForm')}} -->
<?php
// dump(session('new'));
// dump(ENV(''))
// phpurlquery
$queryString = (parse_url(url()->full(), PHP_URL_QUERY));
$params = explode("=",$queryString);
// dump($params);
// dump(url()->full());
?>


<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">


                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class=" text-2xl font-medium text-gray-900 dark:text-white">
                            Send A Mailing </h1>
                        </div>
                        <div>
                            <x-validation-errors />
                            <div>
                                <font color="red">{{ session('message') }}</font>
                                <font color="green">{{ session('success_message') }}</font>
                            </div>
                        </div>
                        <div>
                            <form method="GET" action="/mailing/history">
                                <x-button>
                                    History
                                </x-button>
                            </form>
                        </div>

                        <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                        onchange="location = this.options[this.selectedIndex].value">                               
                        <option value="0"> Select Previous Mailing</option>
                        @foreach ($mailings as $mailing)
                        @if($mailing->id == $option)
                        <option selected value="/send/mailing/{{ $mailing->id }}"> {{ $mailing->subject }}</option>
                        @else
                        <option value="/send/mailing/{{ $mailing->id }}" > {{ $mailing->subject }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
              <main class="mt-10">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8"> 
                    @if($option != 0)
                    <a
                    href="{{ $selectedMailing->url ?? ''}}" target="_blank"
                    id="docs-card"
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                    <div class="relative flex items-start gap-6 lg:items-center">
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $selectedMailing->user->profile_photo_url ?? ''}}" alt="{{ $selectedMailing->user->name ?? ''}}" class="rounded-full size-20 object-cover">
                        </div>
                        <div class="mt-2">
                            <h1 class="text-xl font-semibold text-black dark:text-white">
                                {{ $selectedMailing->subject ?? ''}}
                            </h1>
                        </div> 
                    </div>
                    @if(isset($selectedMailing))
                    <div class="mt-2">
                     {!! nl2br($selectedMailing->body) ?? '' !!}
                 </div>
                 @else
                 <div class="mt-2">
                 </div>
                 @endif

             </a>

             @elseif(isset($ad))                           
             <a 
             href="{{ $ad->url ?? ''}}" target="_blank"
             id="docs-card"
             class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
             >
             <div class="relative flex items-start gap-6 lg:items-center">
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $ad->user->profile_photo_url }}" alt="{{ $ad->user->name }}" class="rounded-full size-20 object-cover">
                </div>
                <div class="mt-2">
                    <h1 class="text-xl font-semibold text-black dark:text-white">
                        {{ $ad->headline ?? ''}}
                    </h1>
                </div> 
            </div>
            <div class="mt-2">
             {!! nl2br($ad->body) ?? '' !!}

         </div>
     </a>
     @else
     <a 
     href="" target="_blank"
     id="docs-card"
     class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
     >
     <div class="relative flex items-start gap-6 lg:items-end">
        <div class="mt-2" x-show="! photoPreview">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full size-20 object-cover">
        </div>
        <div class="mt-2">
            <h1 class="text-xl font-semibold text-black dark:text-white">
                Your Headline Here
            </h1>
        </div> 
    </div>
    <div class="mt-2">
     Your Message Here

 </div>
</a>           
@endif
<div
class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
>
<div class="relative flex items-center gap-6 lg:items-end">
    <div class="mt-2">
        <h1 class="text-xl font-semibold text-black dark:text-white">
            Mailing Privileges
        </h1>
    </div> 
</div>
<div class="mt-2 px-4 py-4  grid lg:grid-cols-2 bg-indigo-200 rounded-md font-semibold">
    <div> Last Mailing</div> <div>{{ App\Models\Mailings::getHumanLastMailing(Auth::user()) }}</div>
    <div> Mailing Status: </div> <div>  {{ App\Models\Mailings::getHumanNextMailing(Auth::user()) }}</div>
    <div> Mailing Bonus: </div> <div> {{ Auth::user()->membership()->mailing_bonus }} on each mailing.<br/></div>
    <div> Max Recipients </div> <div> {{ Auth::user()->membership()->mailing_max }} people per mailing</div>
    <div> Mailing Frequency</div> <div> Send a mailing every {{ Auth::user()->membership()->mailing_freq }} days.</div> 
</div>  

<div class="mt-2">
    <h1 class="text-xl font-semibold text-black dark:text-white">
        Number Of Recipients
    </h1>                        
</div> 

<div> Enter Credits </div> 

<div>
    <x-input id="credits" name="credits" value="0"/>
</div>  
<div> You have {{ Auth::user()->credits }} credits. </div>

<div class="mt-2 px-4 py-4  grid lg:grid-cols-2 bg-indigo-200 rounded-md font-semibold">
    <div> Number of People In Downline</div> <div id="number_people_downline"> 0 </div>
    <div> Bonus Recipients From Upgrade</div> <div id="bonus_credits"> 0</div>
    <div> Credits Spent </div> <div name="credits_spent" id="credits_spent">0</div>
    <div> &nbsp; </div> <div>&nbsp;</div>
    <div> Total Recipients </div> <div id="total_recipients"> 0</div>
    <!-- <div> Total Recipients </div> <div id="total_recipients2"> 0</div> -->
    <!-- <div> Your message will reach</div> <div> 300 recipients</div>  -->
</div>  


<div class="flex flex-row justify-between">
    <!-- Build a form for this send mailing button -->
    <div class="mr-20">

        <form method="POST" action="/mailing/queue">
            @csrf

            @if($option != 0)
  <?php
//   dump($selectedMailing);
// dd($ad);
  ?>

            <input type="hidden" name="id" value="{{ $selectedMailing->id }}" >
            <input type="hidden" name="subject" value="{{ $selectedMailing->subject }}" >
            <input type="hidden" name="body" value="{{ $selectedMailing->body }}" >
            <input type="hidden" name="url" value="{{ $selectedMailing->url }}" >
            <input type="hidden" name="category" value="{{ $selectedMailing->category }}" >
            @elseif(isset($ad)) 
            <input type="hidden" name="subject" value="{{ $ad->headline }}">
            <input type="hidden" name="body" value="{{ $ad->body }}" >
            <input type="hidden" name="url" value="{{ $ad->url }}" >
            <input type="hidden" name="category" value="{{ $ad->category }}">
            @endif

            <input type="hidden" name="number_people_downline" value="" id="myField">
            <input type="hidden" name="mailing_bonus_credits" value="" id="myField2">
            <input type="hidden" name="credits_spent" value="" id="myField3">
            <x-green-button class="" onclick="includeHidden();">
                Send  Mailing
            </x-green-button>
        </form>

    </div>
    <div>
        <!-- <form action="ads/update" method="GET"> -->
            <x-button class="mr-20" onclick="toggleVisibilityEdit()" >
                Edit Ad
            </x-button> 
            <!-- </form>      -->
        </div>
        <div>
            <form action="/mailing/new" method="GET">
                <x-button onclick="toggleVisibilityNew()" >
                    New Ad
                </x-button> 
            </form>     
        </div>


    </div>
</div>                       
</div>

<div class="edit-form">

    @if(!$option)
    <form method="POST" action="/mailing/update">
      @csrf
      <h1 class="mt-10">Enter Your Ad</h1>
      <div class="mt-10 grid grid-cols-1 gap-6 space-between">
          <x-label> Subject</x-label>
          <x-input name="subject" placeholder="Your subject Here" value="{{ $ad->headline ?? old('subject') ?? ''}}"/>
            <x-label> Category </x-label>

            <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option>Select Category</option>
                @foreach ($categories as $category)
                @if (!is_null($ad) && $ad->category == $category->category)
                <option selected> {{ $category->category }} </option>
                @else
                <option> {{ $category->category }} </option>
                @endif
                @endforeach
            </select>

            <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $ad->body ?? old('body' ?? '')}}</textarea>

            <x-label /> Url
            <x-input name="url"  placeholder="Your Url Here" value=" {{ $ad->url ?? old('url') ?? ''}}"/>

                <div class="flex items-start">
                    <x-button class="mr-10">
                       Create New Mailing Ad
                   </x-button>
                   <input type="hidden" name="id" value="{{ $ad->id ?? ''}}">
               </form>
               @elseif ($option)

               <form method="POST" action="/mailing/update">
                  @csrf
                  <h1 class="mt-10">Enter Your Ad</h1>
                  <div class="mt-10 grid grid-cols-1 gap-6 space-between">
                      <x-label> Subject</x-label>
                      <x-input name="subject" placeholder="Your Subject Here" value="{{ $selectedMailing->subject ?? old('subject') ?? ''}}"/>
                        <x-label> Category </x-label>

                        <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            @if (!is_null($selectedMailing) && $selectedMailing->category == $category->category)
                            <option selected> {{ $category->category }} </option>
                            @else
                            <option> {{ $category->category }} </option>
                            @endif
                            @endforeach
                        </select>

                        <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $selectedMailing->body ?? old('body' ?? '')}}</textarea>

                        <x-label /> Url
                        <x-input name="url"  placeholder="Your Url Here" value=" {{ $selectedMailing->url ?? old('url') ?? ''}}"/>

                            <div class="flex items-start">
                                <x-button class="mr-10">
                                   Save
                               </x-button>
                               <input type="hidden" name="id" value="{{ $selectedMailing->id ?? ''}}">
                           </form>
                           <form method="POST" action="/mailing/delete">
                              @csrf
                              <input type="hidden" name="id" value="{{ $selectedMailing->id ?? ''}}">
                              <x-button>
                                 Delete Ad
                             </x-button>
                         </div>
                     </form>
                 </div>
                 @else


                 <div class="new-ad-form">
                     <form method="POST" action="/mailing/store">
                      @csrf
                      <h1 class="mt-10">Enter Your Ad</h1>
                      <div class="mt-10 grid grid-cols-1 gap-6 space-between">
                          <x-label> Headline</x-label>
                          <x-input name="subject" placeholder="Your Subject Here" value=""/>
                          <x-label> Category </x-label>

                          <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            <option> {{ $category->category }} </option>
                            @endforeach
                        </select>

                        <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>

                        <x-label /> Url
                        <x-input name="url"  placeholder="Your Url Here" value=""/>

                        <div class="flex items-start">
                            <x-button class="mr-10">
                               Save
                           </x-button>
                           <input type="hidden" name="id" value="">
                       </form>

                       @endif
                   </main>
               </div>
           </div>
       </div>
   </div>
</div>
</div>
</x-app-layout>





<script>


  var limit = {{ App\Models\User::all()->count() }}


  function onChangeMailBody()
  {
    count = {{App\Models\User::all()->count()}} - $('#message').val().length
    $('#char_left').text(count)
}
$('#message').keyup(onChangeMailBody)
$('#message').keydown(onChangeMailBody)
$('#message').bind('paste', onChangeMailBody)


$('#preview').click(function() {
    message = $('[name="message"]').val();
    $('#message_preview').val(message);
    $('#form_preview').submit()
})

function replaceAll(str, what, to) {
    return str.split(what).join(to);
}

function changeCredits()
{
    credits = parseInt($('[name=credits]').val());
    // console.log(credits);
    number_people_downline = parseInt($('#number_people_downline').text());
    console.log(number_people_downline);
    bonus_credits = parseInt($('#bonus_credits').text());
    guar_send = number_people_downline + bonus_credits;
    console.log('guarsend'+guar_send);

    total = credits + guar_send < limit ? credits + guar_send : limit;

    credits = total - guar_send;

    if (credits  < 0 ){
      credits = 0;
  }
  console.log('credits on the bottom '+credits);
  $('#credits_spent').text(credits);
  $('#total_recipients').text(total);
  $('#total_recipients2').text(total + ' recipients');
}

$('[name=credits]').keyup(changeCredits).keydown(changeCredits).change(changeCredits())



$('#previous_mail').change(function() {
    if ($('#previous_mail option:selected').val() != -1) {
      mail_id = $('#previous_mail option:selected').attr('data-mail_id');
      $('.step2').addClass('wait');
      $('html').addClass('wait');
      $.get('/sendmail/previous/' + mail_id, function(data) {
        if (data === 'false') {

        } else {
          $('[name=subject]').val(data.subject)
          $('[name=url]').val(data.url)
          $('[name=message]').val(data.body);
            // editor.setData(data.body);
              // alert(data.body);
      }
      $('.step2').removeClass('wait');
      $('html').removeClass('wait');
  })
  }
})

$(document).ready(function() {
    changeCredits()


});



function includeHidden() {

    credits_spent = parseInt($('#credits_spent').text());
    number_people_downline = parseInt($('#number_people_downline').text());
    mailing_bonus_credits = parseInt($('#bonus_credits').text());
      // credits = parseInt($('[name=credits]').val());

    console.log(credits_spent);

    console.log(number_people_downline);
    console.log(mailing_bonus_credits);
    // console.log(document.getElementById("subject").innerText);



    document.getElementById('myField').value = number_people_downline;
    document.getElementById('myField2').value = mailing_bonus_credits;
    document.getElementById('myField3').value = credits_spent;
       // document.getElementById('myField3').value = credits;
}

function ajaxCall() {
    $.ajax({

        // Our sample url to make request 
      url:
      '/sendmail/queue/',

          // Type of Request
      type: "POST",

        //the data
      data:{
        "credits_spent":credits_spent,
        "number_people_downline":number_people_downline,
        "mailing_bonus_credits":mailing_bonus_credits,
        "subject": document.getElementById("subject").innerText,
        "url": document.getElementById("url").innerText,
        "message":document.getElementById("message").innerText,
        "_token": '{{ csrf_token() }}'
    },
                // Function to call when to
                // request is ok 
    success: function (data) {
        let x = JSON.stringify(data);
          // console.log(x);
        console.log(data);
        document.getElementById("return_message").innerHTML = data;
    },
                // Error handling 
    error: function (error) {
        console.log(`Error ${error}`);
        alert(error.data);
    }
});
}


</script>
