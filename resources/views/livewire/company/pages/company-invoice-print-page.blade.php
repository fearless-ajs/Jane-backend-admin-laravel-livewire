<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{$data['title']}}</title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">

    @if(Route::currentRouteName() == 'company.print-invoice')
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice-print.css')}}">
    @endif

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice-list.css')}}">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    @livewireStyles
</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
{{--<x-company-app-header />--}}

{{--<x-company-main-menu />--}}

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-body">

        <div class="invoice-print p-3">
            <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
                <div>
                    <div class="d-flex mb-1">
                        <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <linearGradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </linearGradient>
                                <linearGradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <img src="{{$settings->AppImage}}" style="max-width: 10%" />
                                </g>
                            </g>
                        </svg>
                        <h3 class="text-primary fw-bold ms-1">{{$invoice->company->name}}</h3>
                    </div>

                    <p class="mb-25">{{$invoice->company->address}}</p>
                    <p class="mb-25">{{$invoice->company->city}}, {{$invoice->company->state}}, {{$invoice->company->country}}</p>
                    <p class="mb-0">{{$invoice->company->phone}}, {{$invoice->company->email}}</p>
                </div>
                <div class="mt-md-0 mt-2">
                    <h4 class="fw-bold text-end mb-1">INVOICE #{{$invoice->invoice_code}}</h4>
                    <div class="invoice-date-wrapper mb-50">
                        <span class="invoice-date-title">Date Issued:</span>
                        <span class="fw-bold"> {{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</span>
                    </div>
                    <div class="invoice-date-wrapper">
                        <span class="invoice-date-title">Due Date:</span>
                        <span class="fw-bold">{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</span>
                    </div>
                </div>
            </div>

            <hr class="my-2" />
            <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
                <div>

                    <p class="mb-25" style="max-width: 40%;">{{$invoice->company->address}}</p>
                    <p class="mb-25">{{$invoice->company->city}}, {{$invoice->company->state}}, {{$invoice->company->country}}</p>
                    <p class="mb-0">{{$invoice->company->phone}}, {{$invoice->company->email}}</p>
                </div>
                <div class="mt-md-0 mt-2">
                    <h6 class="mb-2">Payment Details:</h6>
                    <table>
                        <tbody>
                        <tr>
                            <td class="pe-1">Total Due:</td>
                            <td><span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($invoice->products_total_price + $invoice->services_total_price)}}</span></td>
                        </tr>
                        <tr>
                            <td class="pe-1">Bank name:</td>
                            <td>{{$invoice->company->bankingInfo->bank_name}}</td>
                        </tr>
                        <tr>
                            <td class="pe-1">Country:</td>
                            <td>{{$invoice->company->bankingInfo->country}}</td>
                        </tr>
                        <tr>
                            <td class="pe-1">IBAN:</td>
                            <td>{{$invoice->company->bankingInfo->iban}}</td>
                        </tr>
                        <tr>
                            <td class="pe-1">SWIFT code:</td>
                            <td>{{$invoice->company->bankingInfo->swift_code}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            @if($invoice->services)

                <div class="table-responsive mt-2">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th class="py-1">Service description</th>
                            <th class="py-1">Rate</th>
                            <th class="py-1">Unit Price</th>
                            <th class="py-1">Volume</th>
                            <th class="py-1">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->services as $service)
                            <tr class="border-bottom">
                                <td class="py-1 ps-4">
                                    <p class="fw-semibold mb-25">{{$service->service->name}}</p>
                                    <p class="text-muted " style="max-width: 50%" >{{$service->description}}</p>
                                </td>
                                <td class="py-1">
                                    <strong>{{$service->usage}}</strong>
                                </td>
                                <td class="py-1">
                                    <strong>{{$settings->app_currency_symbol}}{{number_format($service->unit_price)}}</strong>
                                </td>
                                <td class="py-1">
                                    <strong>{{$service->volume}}</strong>
                                </td>
                                <td class="py-1">
                                    <strong>{{$settings->app_currency_symbol}}{{number_format($service->total_price)}}</strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endif

            @if($invoice->products)

                <div class="table-responsive mt-2">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th class="py-1">Product description</th>
                            <th class="py-1">Unit Price</th>
                            <th class="py-1">Quantity</th>
                            <th class="py-1">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->products as $product)
                            <tr class="border-bottom">
                                <td class="py-1 ps-4">
                                    <p class="fw-semibold mb-25">{{$product->product->name}}</p>
                                    <p class="text-muted " style="max-width: 60%" >{{$product->description}}</p>
                                </td>

                                <td class="py-1">
                                    <strong>{{$settings->app_currency_symbol}}{{number_format($product->unit_price)}}</strong>
                                </td>
                                <td class="py-1">
                                    <strong>{{$product->quantity}}</strong>
                                </td>
                                <td class="py-1">
                                    <strong>{{$settings->app_currency_symbol}}{{number_format($product->total_price)}}</strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endif


            <div class="row invoice-sales-total-wrapper mt-3">
                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                    <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> <span class="ms-75">{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</span></p>
                </div>
                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                    <div class="invoice-total-wrapper">
                        <div class="invoice-total-item">
                            <p class="invoice-total-title">Service total:</p>
                            <p class="invoice-total-amount">{{$settings->app_currency_symbol}}{{number_format($invoice->services_total_price)}}</p>
                        </div>
                        <div class="invoice-total-item">
                            <p class="invoice-total-title">Product total:</p>
                            <p class="invoice-total-amount">{{$settings->app_currency_symbol}}{{number_format($invoice->products_total_price)}}</p>
                        </div>
                        <hr class="my-50" />
                        <div class="invoice-total-item">
                            <p class="invoice-total-title">Total:</p>
                            <p class="invoice-total-amount">{{$settings->app_currency_symbol}}{{number_format($invoice->products_total_price + $invoice->services_total_price)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-2" />

            <div class="row">
                <div class="col-12">
                    <span class="fw-bold">Note:</span>
                    <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                projects. Thank You!</span>
                </div>
                <p>Print</p>
            </div>
        </div>

    </div>

</div>



<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ now()->year }}<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">{{$settings->app_name}}</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>


<!-- END: Content-->


@livewireScripts

<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->


<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/auth-login.js')}}"></script>
<!-- END: Page JS-->

<script src="{{asset('app-assets/js/scripts/pages/app-invoice-print.js')}}"></script>
<!-- BEGIN: Page JS-->

<script>
    window.livewire.on('alert', param => {
        toastr[param['type']](param['message'], param['type']);
    });
</script>


<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>


<script>
    window.livewire.on('close-current-modal', param => {
        $('.current-modal').modal('hide');
    });
</script>

</body>
<!-- END: Body-->

</html>

