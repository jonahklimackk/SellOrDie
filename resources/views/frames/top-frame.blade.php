
<!DOCTYPE html>


<html>

<head> 


	<script src=
	"https://code.jquery.com/jquery-3.6.0.min.js">
</script>



<?php
// $setTimer = true;
if ($setTimer)
	$setTimer = "countdown()";
$nowPlus30Seconds = new Carbon\Carbon('3 seconds');
$nowPlus30Seconds->setTimezone('America/New_York');
?>

<script>
	function countdown() {
// Set the date we're counting down to

		var countDownDate = new Date("{{ $nowPlus30Seconds}}").getTime();

// Update the count down every 1 second
		var x = setInterval(function() {

  // Get today's date and time
			var now = new Date().getTime();

  // Find the distance between now and the count down date
			var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
			document.getElementById("demo").innerHTML = seconds + " s ";

  // If the count down is finished, write some text
			if (distance < 0) {
				clearInterval(x);
				ajaxCall();
				document.getElementById("demo").innerHTML = "";
			}
		}, 1000);
	}

</script>

<link rel="stylesheet" href="/css/reset.css" type="text/css" />
<link rel="stylesheet" href="/css/main.css" type="text/css" />
</head>

<body style="bgcolor: white;" onload="{{ $setTimer ?? '' }}">

	<script>

		function ajaxCall() {
			$.ajax({

                // Our sample url to make request 
				url:
				'/earn/redeem/{{ $creditClick->key }}',

                // Type of Request
				type: "GET",

                // Function to call when to
                // request is ok 
				success: function (data) {
					let x = JSON.stringify(data);
					console.log(x);
					document.getElementById("message").innerHTML = data;
				},

                // Error handling 
				error: function (error) {
					console.log(`Error ${error}`);
				}
			});
		}

	</script>
</body>
<div align="center">
	<table>
		<tr>
			<td>

				<div class="ad">

					<a href='/members/profile/u/{{ $sender->username }}'>
						<img src="{{ $sender->profile_photo_url }}" width='135' height='135' class="rounded"/> 
					</a>
					<div class="info">
						<span class="name">{{ $sender->name }}</span>
					</div>

				</div>
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td valign="top">
				<div id="message">{{ $message ?? ''}}</div>
<!-- 				click after countdown	
	<a href="/earn/redeem/{{ $creditClick->key ?? ''}}">click to earn {{ $creditClick->credits ?? ''}} credits </a> -->
	<p align="center" id="demo"></p>
</td>
</tr>
</table>
</div>



</body>
</html>