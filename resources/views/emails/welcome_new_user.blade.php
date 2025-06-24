@component('mail::layout', ['url' => $loginUrl])
{{-- HEADER --}}
@slot('header')
<tr>
  <td align="center" style="background: #1F2937; padding: 24px 0;">
    <a href="{{ url('/') }}" target="_blank" style="display:inline-block;">
      <img
        src="{{ asset('img/sellordie7.png') }}"
        alt="{{ config('app.name') }} Logo"
        width="96"
        style="display:block;margin:0 auto;border:none;"
      />
    </a>
  </td>
</tr>
@endslot

{{-- DIVIDER BELOW HEADER --}}
<tr>
  <td style="background: #1F2937; border-bottom: 1px solid #ffffff; padding: 0; line-height: 0; font-size: 0;">
    &nbsp;
  </td>
</tr>

{{-- WELCOME MESSAGE --}}
<tr>
  <td style="background: #1F2937; padding: 24px; color: #ffffff;">
    <h1 style="color: #FCD34D; text-align: center; margin: 0 0 16px;">
      Welcome to SellOrDie, {{ $user->name }}!
    </h1>
    <p style="color: #F3F4F6; font-size: 16px; line-height: 1.5em; margin: 0;">
      We’re thrilled to have you join the ultimate ad battleground. Your very first mission: log in and submit your ad to claim your spot in the arena.
    </p>
  </td>
</tr>

{{-- LOGIN BUTTON --}}
<tr>
  <td align="center" style="background: #1F2937; padding: 0 0 16px;">
    @component('mail::button', ['url' => $loginUrl, 'color' => 'yellow'])
    1. Login to Your Account
    @endcomponent
  </td>
</tr>

{{-- CREATE AD BUTTON --}}
<tr>
  <td align="center" style="background: #1F2937; padding: 0 0 24px;">
    @component('mail::button', ['url' => $createAdUrl, 'color' => 'yellow'])
    2. Enter Your First Ad
    @endcomponent
  </td>
</tr>

{{-- DIVIDER ABOVE FOOTER --}}
<tr>
  <td style="background: #1F2937; border-top: 1px solid #ffffff; padding: 0; line-height: 0; font-size: 0;">
    &nbsp;
  </td>
</tr>

{{-- FOOTER --}}
@slot('footer')
<tr>
  <td align="center" style="background: #1F2937; padding: 24px; color: #9CA3AF; font-size: 12px;">
    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
    <a href="{{ url('/') }}" style="color: #FCD34D; text-decoration: none;" target="_blank">
      Visit our site
    </a>
  </td>
</tr>
@endslot
@endcomponent