<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $header ?? '' }}</title>
  </head>
  <body style="margin:0;padding:0;background:#111827;color:#F3F4F6;font-family:Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#111827;width:100%;margin:0;padding:0;">
      <tr>
        <td align="center">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;">
            <tbody>
              {{-- THIS is where notifications/email.blade.php gets injected --}}
              {!! $slot !!}
            </tbody>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
