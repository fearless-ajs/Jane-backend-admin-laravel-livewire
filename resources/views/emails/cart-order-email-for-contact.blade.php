@extends('layouts.email.app')


@section('content')
    <tr>
        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey</p>
            <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367EF;">{{$data['user']->firstname. '  '.$data['user']->lastname }}!</p>
            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Thank you for shopping on {{$settings->app_name}}!
            </p>
            <p style="margin: 0 0 24px;">
                Your order has been placed successfully.
                <span style="font-weight: 600;">Your order</span>will be packed and shipped as soon as possible.
                You will receive a notification from us once the item
                (s) are available for door delivery or collection from your selected Pick-up station.
            </p>
            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Please note:
            </p>
            <p style="margin: 0 0 24px;">
                1. You can track your {{$settings->app_name}} order through your personal {{$settings->app_name}}
                account by clicking here. Cancelling of order is currently unavailable.
                Please note: We are currently working on providing an order cancellation and return policy service
                on {{$settings->app_name}}.
            </p>
            <p style="margin: 0 0 24px;">
                2. If you ordered multiple items, you may receive them on different days.
                This is because they are sold by different sellers on our platform and we want
                to make each item available to you as soon as possible after receiving it.
            </p>

            <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                Items in your order!
            </p>
            <table style="font-family: 'Montserrat',Arial,sans-serif;" cellpadding="0" cellspacing="0" role="presentation">

                @if($data['products'])
                    @foreach($data['products'] as $item)
                        <tr style="text-align: center">
                            <td class="sm-px-0" style="font-family: 'Montserrat',Arial,sans-serif; text-align: left; width: 100%;" width="100%" align="left">
                                <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td class="sm-px-0 sm-pb-32 sm-w-full sm-inline-block" style="font-family: 'Montserrat',Arial,sans-serif; padding-right: 12px; vertical-align: top; width: 50%;" width="50%" valign="top">
                                            <a href="{{route('contact.catalogue-details', $item->catalogue->id)}}"><img src="{{$item->catalogue->images->first()->picture}}" alt="Product image" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; border-radius: 4px; margin-bottom: 12px;"></a>
                                            <h2 style="font-weight: 500; font-size: 14px; line-height: 1.375; margin: 0 0 6px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                                                {{$item->catalogue->name}}
                                            </h2>
                                            <p style="font-size: 12px; margin: 0;">
                                                By <span style="font-weight: 500;">{{$item->catalogue->manufacturer}}</span> in
                                                <span style="font-weight: 500;">Qty: {{$item->quantity}}, Price: {{$settings->currency->currency_symbol}}{{$item->total_product_price}}</span>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 16px; padding-bottom: 16px;"></td>
                        </tr>
                    @endforeach
                @endif

                    @if($data['services'])
                        @foreach($data['services'] as $item)
                            <tr>
                                <td class="sm-px-0" style="font-family: 'Montserrat',Arial,sans-serif; text-align: left; width: 100%;" width="100%" align="left">
                                    <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="sm-px-0 sm-pb-32 sm-w-full sm-inline-block" style="font-family: 'Montserrat',Arial,sans-serif; padding-right: 12px; vertical-align: top; width: 50%;" width="50%" valign="top">
                                                <a href="{{route('contact.catalogue-details', $item->catalogue->id)}}"><img src="{{$item->catalogue->images->first()->picture}}" alt="Product image" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; border-radius: 4px; margin-bottom: 12px;"></a>
                                                <h2 style="font-weight: 500; font-size: 14px; line-height: 1.375; margin: 0 0 6px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                                                    {{$item->catalogue->name}}
                                                </h2>
                                                <p style="font-size: 12px; margin: 0;">
                                                    By <span style="font-weight: 500;">{{$item->catalogue->manufacturer}}</span> in
                                                    <span style="font-weight: 500;">
                                                        Billing:
                                                        @if($item->catalogue->cycle)
                                                            {{$item->catalogue->cycle->title}}
                                                        @else
                                                            Not Available
                                                        @endif
                                                            ,
                                                        Price: {{$settings->currency->currency_symbol}}{{$item->total_service_price}}</span>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 16px; padding-bottom: 16px;"></td>
                            </tr>
                        @endforeach
                    @endif


            </table>

            <p style="margin: 0 0 24px;">
                Please don’t forget to thank your {{$settings->app_name}} delivery agent, who is keeping you safe at home!
                You can also encourage them through our Facebook page using the #{{$settings->app_name}} flag.
                Stay safe & stay healthy.
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
