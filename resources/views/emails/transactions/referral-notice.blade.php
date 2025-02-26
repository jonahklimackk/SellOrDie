
@include('emails.layouts.header')

	{{-- The actual message --}}
	<table width="600" align="center">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">

		<p><h1>You referred somebody new to Listjoe!!</h1></p>

		<p>
			Name: {{ $newMember->name }} <br>
			Email: {{ $newMember->email }} <br>
			Username: {{ $newMember->username }} <br>
			Joined At: {{ $newMember->created_at }}




		<p><b>You earned {{ config('listjoe.referral_bonus') }} credits!</b></p>



<div align="center"><b><a href="{{ config('listjoe.email_url') }}/members/downline">Click here to check your downline</a></b></div>

	<p>	Remember, if this person upgrades and you are not gold, you are losing
	out on a commission! Free members only get 15% commission, bronze gets 25%, silver gets 35% and gold gets 50%</p>

<p>If this person upgrades to Gold, and you are gold, you wll earn a nice commission!</p>
<p><B> <I>But you have to do it first!</I></B></p>

<p>Consider upgrading your membership so you can get the higher commission rates
on all of your downline before they upgrade first.</p>


<div align="center"><b><a href="{{ config('listjoe.email_url') }}/members/upgrade">Click Here to upgrade</a></b></div>

		<p>regards,<br>
		Jonah Klimack<br>
		Listjoe
</p>
<p> P.S. Keep up the good work {{ $recipient->name }}</p>

			</td>
		</tr>
	</table>







<br/>
<hr/>
<br/>





@include('emails.layouts.footer')