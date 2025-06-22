@component('mail::layout', ['url' => $url])
    {{-- Header Slot --}}
    @slot('header')
    <tr>
      <td align="center" style="background: #1F2937; padding: 24px 0;">
        <a href="{{ url('/') }}" target="_blank" style="display: inline-block;">
          <img
            src="https://sellordie.online/img/sellordie7.png"
            alt="SellOrDie Logo"
            width="96"
            style="display: block; margin: 0 auto; border: none;"
          />
        </a>
      </td>
    </tr>
    @endslot

    {{-- Main Body --}}
    <tr>
      <td class="body" style="background: #1F2937; padding: 24px; color: #ffffff;">
        <h1 style="color: #FCD34D; text-align: center; margin-top: 0;">
          {{ __('Verify Your Email Address') }}
        </h1>
        <p style="color: #F3F4F6; line-height: 1.5em; margin: 16px 0;">
          {{ __('Please click the button below to verify your email address.') }}
        </p>

        @component('mail::button', ['url' => $url, 'color' => 'yellow'])
          {{ __('Verify Email Address') }}
        @endcomponent

        <p style="color: #9CA3AF; font-size: 12px; margin-top: 16px;">
          {{ __('If you did not create an account, no further action is required.') }}
        </p>
      </td>
    </tr>

    {{-- Subcopy (optional small print) --}}
    @isset($subcopy)
      @slot('subcopy')
      <tr>
        <td style="background: #1F2937; padding: 16px; color: #9CA3AF; font-size: 12px;">
          {!! $subcopy !!}
        </td>
      </tr>
      @endslot
    @endisset

    {{-- Footer Slot --}}
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
