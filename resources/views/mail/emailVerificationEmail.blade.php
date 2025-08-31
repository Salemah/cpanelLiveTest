{{-- <h1>Email Verification Mail</h1>



Please verify your email with bellow link:

<a href="{{ route('user.verify', $token) }}">Verify Email</a> --}}
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title>Email Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Some clients ignore <style>, so all critical styles are inlined below -->
  <style>
    /* Progressive enhancements for clients that support it */
    @media (max-width: 620px) {
      .wrapper { width: 100% !important; }
      .content { padding: 24px !important; }
      .h1 { font-size: 22px !important; line-height: 28px !important; }
      .btn { display: block !important; width: 100% !important; }
    }
    /* Dark mode hint (not all clients honor this) */
    @media (prefers-color-scheme: dark) {
      body, table, .card { background: #0b0f14 !important; color: #e7eaf0 !important; }
      .btn { background: #4c8bf5 !important; color: #ffffff !important; }
      .muted { color: #9aa4b2 !important; }
      .border { border-color: #223041 !important; }
    }
  </style>
</head>
<body style="margin:0; padding:0; background:#f5f7fb; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji', sans-serif; color:#101828;">

  <!-- Preheader (hidden preview text in inbox) -->
  <div style="display:none; visibility:hidden; opacity:0; height:0; width:0; overflow:hidden; mso-hide:all;">
    Confirm your email to finish setting up your account.
  </div>

  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f7fb;">
    <tr>
      <td align="center" style="padding: 32px 16px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" class="wrapper" style="width:600px; max-width:100%;">
          <!-- Header -->
          <tr>
            <td align="center" style="padding: 8px 0 24px 0;">
                {{$Setting->title ?? ''}}
              {{-- <a href="{{ $website ?? url('/') }}" target="_blank" style="text-decoration:none;">
                <img src="{{ isset($logo) ? asset('image/dashboard/'.$logo) : asset('logo2.png') }}" width="120" height="auto" alt="{{ $title ?? config('app.name') }}" style="border:0; outline:none; text-decoration:none; display:block;">
              </a> --}}
            </td>
          </tr>

          <!-- Card -->
          <tr>
            <td class="card border" style="background:#ffffff; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td class="content" style="padding: 32px;">
                    <h1 class="h1" style="margin:0 0 12px 0; font-size:24px; line-height:32px; font-weight:700;">
                      Verify your email
                    </h1>

                    <p style="margin:0 0 16px 0; font-size:16px; line-height:24px;">
                      Hi {{ $data->name ?? ($data->name ?? 'there') }}, thanks for signing up for
                      <strong>{{ $Setting->title ?? config('app.name') }}</strong>. Please confirm your email address to activate your account.
                    </p>

                    <!-- Button -->
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 24px 0 8px 0;">
                      <tr>
                        <td>
                          <a href="{{ route('user.verify', $token) }}"
                             class="btn"
                             style="display:inline-block; background:#2563eb; color:#ffffff; text-decoration:none; padding:12px 20px; border-radius:10px; font-weight:600; font-size:16px;">
                            Verify Email
                          </a>
                        </td>
                      </tr>
                    </table>

                    <!-- Fallback link -->
                    <p class="muted" style="margin:16px 0 0 0; font-size:13px; line-height:20px; color:#667085;">
                      If the button doesn’t work, copy and paste this URL into your browser:
                    </p>
                    <p style="margin:8px 0 0 0; font-size:13px; line-height:20px; word-break:break-all;">
                      <a href="{{ route('user.verify', $token) }}" style="color:#2563eb; text-decoration:underline;">
                        {{ route('user.verify', $token) }}
                      </a>
                    </p>

                    <!-- Expiry/help note (optional) -->
                    <p class="muted" style="margin:20px 0 0 0; font-size:13px; line-height:20px; color:#667085;">
                      For security, this link may expire after a short time or after it is used once. If it has expired,
                      you can request a new verification email from your account page or by logging in again.
                    </p>

                    <!-- Divider -->
                    <hr style="border:none; border-top:1px solid #e5e7eb; margin:24px 0;">

                    <!-- Footer meta -->
                    <p class="muted" style="margin:0 0 4px 0; font-size:12px; line-height:18px; color:#9aa4b2;">
                      Need help? Reply to this email or contact us at
                      <a href="mailto:{{ $Setting->email ?? ($Setting->email ?? 'support@example.com') }}" style="color:#2563eb; text-decoration:underline;">
                        {{ $Setting->email ?? ($Setting->email ?? 'support@example.com') }}
                      </a>.
                    </p>
                    <p class="muted" style="margin:0; font-size:12px; line-height:18px; color:#9aa4b2;">
                      © {{ date('Y') }} {{ $Setting->title ?? config('app.name') }}. All rights reserved.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Social / Footer (optional) -->
          <tr>
            <td align="center" style="padding: 16px 8px 0 8px;">
              <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  @if(!empty($Setting->facebook))
                  <td style="padding: 0 6px;">
                    <a href="{{ $Setting->facebook }}" target="_blank" style="font-size:12px; color:#667085; text-decoration:none;">Facebook</a>
                  </td>
                  @endif
                  @if(!empty($Setting->instagram))
                  <td style="padding: 0 6px;">
                    <a href="{{ $Setting->instagram }}" target="_blank" style="font-size:12px; color:#667085; text-decoration:none;">Instagram</a>
                  </td>
                  @endif
                  @if(!empty($Setting->website))
                  <td style="padding: 0 6px;">
                    <a href="{{ $Setting->website }}" target="_blank" style="font-size:12px; color:#667085; text-decoration:none;">Website</a>
                  </td>
                  @endif
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td align="center" style="padding: 8px 0 32px 0;">
              <p class="muted" style="margin:0; font-size:11px; line-height:16px; color:#9aa4b2;">
                You received this message because an account was created using this email address.
                If you didn’t create the account, you can safely ignore this email.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

  <!--[if mso]>
  <style type="text/css">
    .btn { padding:0 !important; }
  </style>
  <table role="presentation" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" style="background:#2563eb; border-radius:10px;">
        <a href="{{ route('user.verify', $token) }}" style="display:inline-block; padding:12px 20px; color:#ffffff; text-decoration:none; font-weight:600;">Verify Email</a>
      </td>
    </tr>
  </table>
  <![endif]-->
</body>
</html>
