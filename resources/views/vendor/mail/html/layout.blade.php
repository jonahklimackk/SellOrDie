<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body
    style="
      margin: 0;
      padding: 0;
      background-color: #1F2937;
      color: #ffffff;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      line-height: 1.4;
      width: 100% !important;
    "
>
    <table
      class="wrapper"
      width="100%"
      cellpadding="0"
      cellspacing="0"
      role="presentation"
      style="background-color: #1F2937; margin: 0; padding: 0; width: 100%;"
    >
        <tr>
            <td align="center">
                <table
                  class="content"
                  width="100%"
                  cellpadding="0"
                  cellspacing="0"
                  role="presentation"
                  style="max-width: 600px; margin: 0 auto; padding: 0;"
                >

                    {{-- Header (if provided) --}}
                    @isset($header)
                      {{ $header }}
                    @endisset

                    {{-- YOUR verify-email.blade.php rows go here --}}
                    {!! $slot !!}

                    {{-- Subcopy slot --}}
                    @isset($subcopy)
                      {{ $subcopy }}
                    @endisset

                    {{-- Footer slot --}}
                    @isset($footer)
                      {{ $footer }}
                    @endisset

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
