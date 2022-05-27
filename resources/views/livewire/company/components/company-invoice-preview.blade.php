<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12">
        <div class="card invoice-preview-card">
            <div class="card-body invoice-padding pb-0">
                <!-- Header starts -->
                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                    <div>
                        <div class="logo-wrapper">
                            <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </linearGradient>
                                    <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-400.000000, -178.000000)">
                                        <g transform="translate(400.000000, 178.000000)">
                                            <img src="{{$settings->AppImage}}" style="max-width: 10%" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <h3 class="text-primary invoice-logo">{{\Illuminate\Support\Facades\Auth::user()->company->name}}</h3>
                        </div>
                        <p class="card-text mb-25 w-50">{{Auth::user()->company->address}}</p>
                        <p class="card-text mb-25">{{Auth::user()->company->city}}, {{Auth::user()->company->state}}, {{Auth::user()->company->country}}</p>
                        <p class="card-text mb-0">{{Auth::user()->company->phone}}, {{Auth::user()->company->email}}</p>
                    </div>
                    <div class="mt-md-0 mt-2">
                        <h4 class="invoice-title">
                            Invoice
                            <span class="invoice-number">#{{$invoice->invoice_code}}</span>
                        </h4>
                        <div class="invoice-date-wrapper">
                            <p class="invoice-date-title">Date Issued:</p>
                            <p class="invoice-date">{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</p>
                        </div>
                        <div class="invoice-date-wrapper">
                            <p class="invoice-date-title">Due Date:</p>
                            <p class="invoice-date">{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</p>
                        </div>
                    </div>
                </div>
                <!-- Header ends -->
            </div>

            <hr class="invoice-spacing" />

            <!-- Address and Contact starts -->
            <div class="card-body invoice-padding pt-0">
                <div class="row invoice-spacing">
                    <div class="col-xl-8 p-0">
                        <h6 class="mb-2">Invoice To:</h6>
                        <h6 class="mb-25">{{$invoice->contactInfo->user->lastname. '  '.$invoice->contactInfo->user->firstname}}</h6>
                        <p class="card-text mb-25">{{$invoice->contactInfo->address}}</p>
                        <p class="card-text mb-25">{{$invoice->contactInfo->office_phone}}</p>
                        <p class="card-text mb-25">{{$invoice->contactInfo->mobile_phone}}</p>
                        <p class="card-text mb-0">{{$invoice->contactInfo->primary_email}}</p>
                    </div>
                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                        <h6 class="mb-2">Payment Details:</h6>
                        <table>
                            <tbody>
                            <tr>
                                <td class="pe-1">Total Due:</td>
                                <td><span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($invoice->products_total_price + $invoice->services_total_price)}}</span></td>
                            </tr>
                            <tr>
                                <td class="pe-1">Bank name:</td>
                                <td>{{Auth::user()->company->bankingInfo->bank_name}}</td>
                            </tr>
                            <tr>
                                <td class="pe-1">Country:</td>
                                <td>{{Auth::user()->company->bankingInfo->country}}</td>
                            </tr>
                            <tr>
                                <td class="pe-1">IBAN:</td>
                                <td>{{Auth::user()->company->bankingInfo->iban}}</td>
                            </tr>
                            <tr>
                                <td class="pe-1">SWIFT code:</td>
                                <td>{{Auth::user()->company->bankingInfo->swift_code}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Address and Contact ends -->

            <!-- Invoice Description starts -->


            @if($invoice->services)
                <div class="table-responsive">
                <table class="table">
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
                            <td class="py-1">
                                <p class="card-text fw-bold mb-25">{{$service->service->name}}</p>
                                <p class="card-text text-nowrap">{{Str::limit($service->description, 60, $end='...')}}</p>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">{{$service->usage}}</span>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($service->unit_price)}}</span>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">{{$service->volume}}</span>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($service->total_price)}}</span>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            @endif

            @if($invoice->products)
                <div class="table-responsive">
                    <table class="table">
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
                                <td class="py-1">
                                    <p class="card-text fw-bold mb-25">{{$product->product->name}}</p>
                                    <p class="card-text text-nowrap">{{Str::limit($product->description, 60, $end='...')}}</p>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($product->unit_price)}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$product->quantity}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$settings->app_currency_symbol}}{{number_format($product->total_price)}}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @endif



            <div class="card-body invoice-padding pb-0">
                <div class="row invoice-sales-total-wrapper">
                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        <p class="card-text mb-0">
                            <span class="fw-bold">Salesperson:</span> <span class="ms-75">{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</span>
                        </p>
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
{{--                            <div class="invoice-total-item">--}}
{{--                                <p class="invoice-total-title">Discount:</p>--}}
{{--                                <p class="invoice-total-amount">$28</p>--}}
{{--                            </div>--}}
{{--                            <div class="invoice-total-item">--}}
{{--                                <p class="invoice-total-title">Tax:</p>--}}
{{--                                <p class="invoice-total-amount">21%</p>--}}
{{--                            </div>--}}
                            <hr class="my-50" />
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Total:</p>
                                <p class="invoice-total-amount">{{$settings->app_currency_symbol}}{{number_format($invoice->products_total_price + $invoice->services_total_price)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Invoice Description ends -->

            <hr class="invoice-spacing" />

            <!-- Invoice Note starts -->
            <div class="card-body invoice-padding pt-0">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-bold">Note:</span>
                        <span>{{$invoice->note}}</span>
                    </div>
                </div>
            </div>
            <!-- Invoice Note ends -->
        </div>
    </div>
    <!-- /Invoice -->

    <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
                    Send Invoice
                </button>
                 <a class="btn btn-outline-secondary w-100 mb-75" href="{{route('company.print-invoice', $invoice->id)}}" target="_blank"> Print </a>
                <a class="btn btn-outline-success w-100 mb-75" href="{{route('company.edit-invoice', $invoice->id)}}"> Edit </a>
            </div>
        </div>
    </div>
    <!-- /Invoice Actions -->
</div>
