<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ __('emails.password_reset.title') }}</title>

  <style>

    body { margin: 0; padding: 0; background-color: #f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

    a { text-decoration: none; }

    @media only screen and (max-width: 600px) {

      .wrapper { width: 100% !important; padding: 24px 16px !important; }

      .card { padding: 40px 24px !important; }

    }

  </style>

</head>

<body>

  <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color:white; padding: 48px 16px;">

    <tr>

      <td align="center">

        <table class="wrapper" width="560" cellpadding="0" cellspacing="0" role="presentation">

          <!-- Logo -->

          <tr>

            <td align="center">

              <a href="{{ route('home') }}">
                <img
                  src="{{ asset('images/logo.png') }}"
                  alt="Everflake"
                  width="172"
                  height="122"
                  style="display:block; border:0;"
                />
              </a>

            </td>

          </tr>

          <!-- Card -->

          <tr>

            <td class="card" style="background-color: #ffffff; border-radius: 2px; padding: 26px 64px;">

              <!-- Badge Espace Collectionneur -->

              <table cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 24px;">

                <tr>

                  <!-- Angle suisse -->

                  <td style="padding-right: 10px; vertical-align: middle;">

                    <table cellpadding="0" cellspacing="0" role="presentation" style="width:10px;">

                      <tr>

                        <td style="background-color:#c8102e; width:10px; height:3px; font-size:0; line-height:0;">&nbsp;</td>

                      </tr>

                      <tr>

                        <td style="width:10px; height:7px; font-size:0; line-height:0; padding:0;">

                          <table cellpadding="0" cellspacing="0" role="presentation">

                            <tr>

                              <td style="background-color:#c8102e; width:3px; height:7px; font-size:0; line-height:0;">&nbsp;</td>

                              <td style="width:7px; height:7px;">&nbsp;</td>

                            </tr>

                          </table>

                        </td>

                      </tr>

                    </table>

                  </td>

                  <!-- Texte -->

                  <td style="font-family: 'Courier New', monospace; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #c8102e; vertical-align: middle;">

                    {{ __('emails.password_reset.collector_space') }}

                  </td>

                </tr>

              </table>

              <!-- Titre -->

              <h1 style="margin: 0 0 12px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 28px; font-weight: 800; color: #111111; line-height: 1.2;">

                {{ __('emails.password_reset.heading_line_1') }}<br/>{{ __('emails.password_reset.heading_line_2') }}

              </h1>

              <!-- Intro -->

              <p style="margin: 0 0 32px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 14px; color: #6b6b6b; line-height: 1.6;">

                {{ __('emails.password_reset.intro') }}

              </p>

              <!-- Bouton CTA -->

              <table cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 32px;">

                <tr>

                  <td style="background-color: #c8102e; border-radius: 2px;">

                    <a href="{{ $url }}" style="display: inline-block; padding: 14px 32px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 13px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #ffffff;">

                      {{ __('emails.password_reset.cta') }}

                    </a>

                  </td>

                </tr>

              </table>

              <!-- Expiration -->

              <table cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 32px; background-color: #f9fafb; border-left: 3px solid #e5e7eb; padding: 0;">

                <tr>

                  <td style="padding: 14px 18px;">

                    <p style="margin: 0; font-family: 'Courier New', monospace; font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #9ca3af;">

                      {{ __('emails.password_reset.expiration') }}

                    </p>

                  </td>

                </tr>

              </table>

              <!-- Séparateur -->

              <table cellpadding="0" cellspacing="0" role="presentation" width="100%" style="margin-bottom: 24px;">

                <tr>

                  <td style="border-top: 1px solid #e5e7eb; font-size: 0; line-height: 0;">&nbsp;</td>

                </tr>

              </table>

              <!-- Lien texte fallback -->

              <p style="margin: 0 0 8px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 12px; color: #9ca3af; line-height: 1.5;">

                {{ __('emails.password_reset.fallback_intro') }}

              </p>

              <p style="margin: 0 0 32px 0; font-family: 'Courier New', monospace; font-size: 11px; color: #6b6b6b; word-break: break-all;">

                {{ $url }}

              </p>

              <!-- Avertissement sécurité -->

              <p style="margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 13px; color: #9ca3af; line-height: 1.6;">

                {{ __('emails.password_reset.security_notice') }}

              </p>

            </td>

          </tr>

          <!-- Footer -->

          <tr>

            <td style="padding: 32px 0 0 0;">

              <table cellpadding="0" cellspacing="0" role="presentation" width="100%">

                <tr>

                  <td align="center" style="padding-bottom: 12px;">

                    <p style="margin: 0; font-family: 'Courier New', monospace; font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase; color: #9ca3af;">

                      {{ __('emails.password_reset.security_footer') }}

                    </p>

                  </td>

                </tr>

                <tr>

                  <td align="center">

                    <p style="margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 12px; color: #9ca3af;">

                      {{ __('emails.password_reset.copyright', ['year' => date('Y')]) }}

                      &nbsp;·&nbsp;

                      <a href="{{ $url }}" style="color: #9ca3af; text-decoration: underline;">

                        {{ __('emails.password_reset.unsubscribe') }}

                      </a>

                    </p>

                  </td>

                </tr>

              </table>

            </td>

          </tr>

        </table>

      </td>

    </tr>

  </table>

</body>

</html>