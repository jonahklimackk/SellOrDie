<!DOCTYPE html>
<html>

<head> 


	<link rel="stylesheet" href="/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="/css/main.css" type="text/css" />
</head>

<body style="bgcolor: white;">


	<div align="center">
		<table>
			<tr>
				<td>

					<div class="ad">
						<a href='/members/profile/u/{{ Auth::user()->username }}'>
							<img src='{{ Auth::user()->profile_photo_url }}' width='40' height='40' class='photo'/>
						</a>
						<div class="info">
							<span class="name">{{ Auth::user()->name }}</span>
							<img class="star" src="/img/spotlights_ads_star.png"/>
							
							<div class="rating">Joe Rating: {{ Auth::user()->getRating() }}%</div>
						</div>

					</div>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td valign="top">
					<b>{{ $message ?? ''}}</b>

				</td>
			</tr>
		</table>
	</div>
</body>
</html>