@extends('layouts.email.app')


@section('content')
    <tr>
        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey</p>
            <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367EF;">{{$data['user']->firstname. '  '.$data['user']->lastname }}!</p>
            <p style="margin: 0 0 24px;">
               {{$data['message']}}
            </p>
            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Please note:
            </p>
            <p style="margin: 0 0 24px;">
               You can track your service through your personal {{$settings->app_name}}
                account.
            </p>

            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Item Details
            </p>
            <table style="font-family: 'Montserrat',Arial,sans-serif;" cellpadding="0" cellspacing="0" role="presentation">

                <tr>
                    <td class="sm-px-0" style="font-family: 'Montserrat',Arial,sans-serif; text-align: left; width: 100%;" width="100%" align="left">
                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="sm-px-0 sm-pb-32 sm-w-full sm-inline-block" style="font-family: 'Montserrat',Arial,sans-serif; padding-right: 12px; vertical-align: top; width: 50%;" width="50%" valign="top">
                                    <img src="{{$data['item']->catalogue->images->first()->picture}}" alt="Product image" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; border-radius: 4px; margin-bottom: 12px;">
                                    <h2 style="font-weight: 500; font-size: 14px; line-height: 1.375; margin: 0 0 6px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                                        {{$data['item']->catalogue->name}}
                                    </h2>
                                    <p style="font-size: 12px; margin: 0;">
                                        By <span style="font-weight: 500;">{{$data['item']->catalogue->manufacturer}}</span> in
                                        <span style="font-weight: 500;">
                                                        Billing:
                                                        @if($data['item']->catalogue->cycle)
                                                {{$data['item']->catalogue->cycle->title}}
                                            @else
                                                Not Available
                                            @endif
                                                            ,
                                               Price: {{$settings->currency->currency_symbol}}

                                            @if($data['item']->catalogue->tax)
                                                {{ (($data['item']->catalogue->tax->percentage / 100 ) * $data['item']->catalogue->price) + $data['item']->catalogue->price }}
                                            @else
                                                {{ $data['item']->catalogue->price }}
                                            @endif

                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 16px; padding-bottom: 16px;"></td>
                </tr>



            </table>

{{--            <p style="margin: 0 0 24px;">--}}
{{--                Please don’t forget to thank your {{$settings->app_name}} delivery agent, who is keeping you safe at home!--}}
{{--                You can also encourage them through our Facebook page using the #{{$settings->app_name}} flag.--}}
{{--                Stay safe & stay healthy.--}}
{{--            </p>--}}


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
