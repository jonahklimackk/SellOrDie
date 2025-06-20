<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px 0;">
  <tr>
    <td align="center">
      <a
        href="{{ $url }}"
        target="_blank"
        style="
          display: inline-block;
          padding: 12px 24px;
          background-color: #FBBF24;
          color: #1F2937;
          font-family: Arial, sans-serif;
          font-size: 16px;
          font-weight: 600;
          text-decoration: none;
          text-transform: uppercase;
          border-radius: 6px;
          box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        "
        onmouseover="this.style.backgroundColor='#F59E0B'"
        onmouseout="this.style.backgroundColor='#FBBF24'"
      >
        {{ $slot }}
      </a>
    </td>
  </tr>
</table>
