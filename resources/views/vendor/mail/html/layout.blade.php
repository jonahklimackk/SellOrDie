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
            {{-- Email Header --}}
            {{ $header }}

            {{-- Email Body --}}
            <tr>
              <td style="background-color:#1F2937;padding:0;">
                <table role="presentation" align="center" width="100%" cellpadding="0" cellspacing="0" style="background-color:#1F2937;color:#F3F4F6;width:100%;max-width:570px;margin:0 auto;padding:24px;">
                  {{ $slot }}
                </table>
              </td>
            </tr>

            {{-- Email Footer --}}
            {{ $footer }}
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
