{{-- resources/views/vendor/notifications/email.blade.php --}}
@component('mail::layout')
  {{-- Header Slot --}}
  @slot('header')
  <tr>
    <td align="center" style="background:#B91C1C;padding:24px 0;">
      <a href="{{ url('/') }}" target="_blank" style="display:inline-block;">
        <img
          src="http://sellordie.online/img/sellordie7.png"
          alt="SellOrDie Logo"
          width="96"
          style="display:block;height:96px;border:none;margin:0 auto;"
        />
      </a>
    </td>
  </tr>
  @endslot

  {{-- Body --}}
  {!! $slot !!}

  {{-- Subcopy Slot (if any) --}}
  @isset($subcopy)
    @slot('subcopy')
    <tr>
      <td style="background:#1F2937;padding:0;">
        <table role="presentation" width="100%" style="background:#1F2937;color:#9CA3AF;padding:16px;">
          <tr>
            <td style="font-size:12px;line-height:1.5;">
              {!! $subcopy !!}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    @endslot
  @endisset

  {{-- Footer Slot --}}
  @slot('footer')
  <tr>
    <td align="center" style="background:#1F2937;padding:24px;font-size:12px;line-height:1.5;color:#9CA3AF;">
      &copy; {{ date('Y') }} SellOrDie. All rights reserved.<br>
      <a href="{{ url('/') }}" style="color:#FCD34D;text-decoration:none;" target="_blank">
        Visit our site
      </a>
    </td>
  </tr>
  @endslot
@endcomponent
