


@include('emails.layouts.header')


	{{-- The actual message --}}
	<table width="600" align="center">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">

		<p><h1>Your mailing was sent!</h1></p>

	Check your stats, we track emails opens and clicks, we are the only mailer that does this.<p>

		 <p>So let's see how many actual opens you get and the clicks also.</p>

<b><a href="{{ config('listjoe.email_url') }}/mail_history">Click here to check your stats</a></b>

	<p>	If your offer did well, consider upgrading to gold or buying some credits. If you found a winner strike while the iron is hot!</p>

<div align="center"><h3><a href="{{ config('listjoe.email_url') }}/members/upgrade"> Upgrade Now! </a></h3></div>


		<p>Regards,<br>
		Jonah Klimack<br>
		Listjoe
</p>
<p> P.S. We have a 50% off special going on now,
	it may or may not still be on, upgrade now before
it's too late</p>

<div align="center"><h3><a href="{{ config('listjoe.email_url'	) }}/show/oto> Upgrade Now! </a></h3></div>


			</td>
		</tr>
	</table>







<br/>
<hr/>
<br/>





@include('emails.layouts.footer')
