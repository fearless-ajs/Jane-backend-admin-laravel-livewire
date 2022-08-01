@extends('layouts.email.app')


@section('content')
    <tr>
        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hi,</p>
            <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367EF;">{{$user->firstname. '  '.$user->lastname }}!</p>
            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Thank you for choosing sandpiper {{$settings->app_name}}!
            </p>
            <p style="margin: 0 0 24px;">
                Kindly verify your email address to ensure we have the working
                email, we need this to  <span style="font-weight: 600;">activate</span> your account.
                Please click the below button to verify your account
            </p>
            <p class="sm-leading-32" style="font-weight: 600; text-align: center; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                <a class="butt" href="{{route('verify-email', $user->verification_token)}}">Verify Email</a>
            </p>

            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 32px; padding-bottom: 32px;">
                        <div style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); height: 1px; line-height: 1px;">&zwnj;</div>
                    </td>
                </tr>
            </table>
            <p style="margin: 0 0 16px;">
                Not sure why you received this email? Please
                <a href="mailto:{{$settings->app_email}}" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">let us know</a>.
            </p>
            <p style="margin: 0 0 16px;">Thanks, <br>The {{$settings->app_name}} Team</p>
        </td>
    </tr>
@endsection
