



@include('emails.layouts.header')


	{{-- The actual message --}}
	<table width="600" align="center">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">

		<p><h2>Welcome to Listjoe!</h2></p>

		<p>{{ strtok($recipient->name,' ') }} here is an interesting yet profitable way to advertise your website, whatever that may be...</p>

		<p><b>In 5 minutes, people will <i>visit</i> your website, Guaranteed!</b></p>
		
		<p>Whenever I had something to promote, and couldn't think off the top of my head any other place to advertise it, <i><b>I turned to Listjoe and credit for mail type mailers.</b></i></p>

		<p>	{{ strtok($recipient->name,' ') }}	sometimes, I use them just to get a feeling for the ad I want to send. With Listjoe you can... <b><i>in an instant</i></b>, get the feedback  need to tell you if this thing you're  promoting is a winner or not.
		</p>

		<p>It's easy enough to get started at Listjoe {{ strtok($recipient->name,' ') }}, just build up some credits and then send a mailing. For every email you click on, you'll get between 20 and 50 credits. It's random everytime so you never know if you're going to get 50 credits, or just 20, but either way, you only need to click on a dozen or so emails and you've got 3 or 4 hundred credits.</p>

		<p><b>{{ strtok($recipient->name,' ') }} next time you have something to promote... <i>turn to Listjoe.</i></b> It's like dipping your toes in the water to see if its too cold. if your ad is too cold, or if it's really hot. You'll find out in just a few minutes.</p>

		<p><b>There's no other place I know of to get instant feedback on your offer like this.</b></p>


		<p>Of course , as an upgraded member you get the maximum bang for your buck....</p>

		<div align="center"><h2>
		<a href="http://listjoe.com/members/upgrade"> All of our prices are 50% off!</a></h2>
		</div>

		<p><i>Hundreds of people are joining every day</i>, and its happening really really fast, so here you have a new exciting list of people eager to read your listjoe emails.</p>

<div align="center">
		<p><b><h2><a href="http://listjoe.com/members/upgrade">Click Here to get 50% off all memberships and credit buys for a limited time! </a></h2></b></p></div>

		<p><i><b> Test your next offer in just a few clicks,</b></i> or, use the steady approach of gaining a dozen opt in members per mailing. </p>

		<p>That's another way to play the credit mailer game, just send the same ad over and over inviting people to your mailing list. You'll get dozens of subscribers per day, nice and steady.</p>


<div align="center">
	<p><h2><a href="http://listjoe.com/members/upgrade">Recommended by every top mailer out there, upgrade to Listjoe right now and send your mailing</a></h2></p></div>

<br>
	<p>Best of luck in your promotions,<br>
		Jonah Klimack, <br> 
		Founder, <br>
		Listjoe
	</p>
	<p> P.S. {{ strtok($recipient->name,' ') }}  of course there's a ps. Wouldn't you like to have an instant traffic faucet like Listjoe at your finger tips?</p>

<p><b><a href="http://listjoe.com/members/upgrade">upgrade now</a></p>
			</td>
		</tr>
	</table>







<br/>
<hr/>
<br/>



@include('emails.layouts.footer')