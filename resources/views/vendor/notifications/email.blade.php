<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $header ?? '' }}</title>
  </head>
  <body style="margin:0;padding:0;background-color:#111827;color:#F3F4F6;font-family:Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#111827;width:100%;margin:0;padding:0;">
      <tr>
        <td align="center">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;margin:0 auto;">
            
            {{-- Header --}}
            <tr>
              <td align="center" style="background-color:#B91C1C;padding:24px 0;">
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

            {{-- Email Body --}}
            <tr>
              <td style="background-color:#1F2937;padding:0;">
                <table role="presentation" align="center" width="100%" cellpadding="0" cellspacing="0"
                       style="background-color:#1F2937;color:#F3F4F6;width:100%;max-width:570px;margin:0 auto;padding:24px;">
                  {{ $slot }}
                </table>
              </td>
            </tr>

            {{-- Subcopy (if any) --}}
            @isset($subcopy)
            <tr>
              <td style="background-color:#1F2937;padding:0;">
                <table role="presentation" align="center" width="100%" cellpadding="0" cellspacing="0"
                       style="background-color:#1F2937;color:#9CA3AF;width:100%;max-width:570px;margin:0 auto;padding:16px;">
                  <tr>
                    <td style="font-size:12px;line-height:1.5;">
                      {{ $subcopy }}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            @endisset

            {{-- Footer --}}
            <tr>
              <td align="center" style="background-color:#1F2937;padding:24px;font-size:12px;line-height:1.5;color:#9CA3AF;">
                &copy; {{ date('Y') }} SellOrDie. All rights reserved.<br />
                <a href="{{ url('/') }}" target="_blank" style="color:#FCD34D;text-decoration:none;">
                  Visit our site
                </a>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
