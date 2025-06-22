@component('mail::layout', ['url' => $acceptUrl])
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

{{-- INVITATION MESSAGE --}}
<tr>
  <td style="background: #1F2937; padding: 24px; color: #ffffff;">

    <h1 style="color: #FCD34D; text-align: center; margin: 0 0 16px;">
      {{ __("You've been challenged to the “:fight” fight!", [
      'fight' => $invitation->team->name
      ]) }}
    </h1>
    <p style="margin: 0 0 16px; line-height: 1.5em;">
      {{ __('If you do not have a SellOrDie account, create one for free below and then accept the challenge.') }}
    </p>
  </td>
</tr>

{{-- CREATE ACCOUNT BUTTON --}}
<tr>
  <td align="center" style="background: #1F2937; padding: 0 0 24px;">
    @component('mail::button', [
    'url' => $affiliateLink,
    'color' => 'yellow'
    ])
    {{ __('Create Account') }}
    @endcomponent
  </td>
</tr>

{{-- ACCEPT CHALLENGE BUTTON --}}
<tr>
  <td align="center" style="background: #1F2937; padding: 0 0 24px;">
    @component('mail::button', ['url' => $acceptUrl, 'color' => 'yellow'])
    {{ __('Accept Challenge') }}
    @endcomponent
  </td>
</tr>

{{-- FOOTER --}}
@slot('footer')
<tr>
  <td align="center" style="background: #1F2937; padding: 24px; color: #9CA3AF; font-size:12px;">
    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
    <a href="{{ url('/') }}" style="color: #FCD34D; text-decoration: none;" target="_blank">
      {{ __('Visit our site') }}
    </a>
  </td>
</tr>
@endslot
@endcomponent
