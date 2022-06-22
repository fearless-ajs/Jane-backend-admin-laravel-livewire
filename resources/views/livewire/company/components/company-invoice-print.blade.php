<div class="invoice-print p-3">
    <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
        <div>
            <div class="d-flex mb-1">
                <h3 class="text-primary fw-bold">{{$invoice->company->name}}</h3>
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

            @if($invoice->contactInfo)
                <p class="mb-25" style="max-width: 40%;">{{$invoice->contactInfo->address}}</p>
                <p class="mb-25">{{$invoice->contactInfo->city}}, {{$invoice->contactInfo->state}}, {{$invoice->contactInfo->country}}</p>
                <p class="mb-0">{{$invoice->contactInfo->mobile_phone}}, {{$invoice->contactInfo->email}}</p>
            @else
                <p class="mb-25" style="max-width: 40%;">Contact details not available</p>
            @endif
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
                    <th class="py-1">Price</th>
                    <th class="py-1">Billing</th>
                    <th class="py-1">Tax</th>
                    <th class="py-1">Price</th>
                    <th class="py-1">Price + Tax</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->services as $service)
                    <tr class="border-bottom">
                        <td class="py-1 ps-4">
                            <p class="fw-semibold mb-25">{{$service->catalogue->name}}</p>
                            <p class="text-muted " style="max-width: 50%" >{{$service->description}}</p>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$service->unit_price}}</span>
                        </td>
                        <td class="py-1">
                            @if($service->catalogue->cycle)
                                <span class="fw-bold">{{$service->catalogue->cycle->title}}</span>
                            @else
                                <span class="fw-bold text-danger">Not available</span>
                            @endif
                        </td>

                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$service->total_tax}}</span>
                        </td>

                        {{--                                        <td class="py-1">--}}
                        {{--                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['unit_price']}}</span>--}}
                        {{--                                        </td>--}}

                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$service->total_price}}</span>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$service->total_price_with_tax}}</span>
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
                    <th class="py-1">Tax</th>
                    <th class="py-1">Price</th>
                    <th class="py-1">Price + Tax</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->products as $product)
                    <tr class="border-bottom">
                        <td class="py-1 ps-4">
                            <p class="fw-semibold mb-25">{{$product->catalogue->name}}</p>
                            <p class="text-muted " style="max-width: 60%" >{{$product->description}}</p>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$product->unit_price}}</span>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$product->quantity}}</span>
                        </td>

                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$product->total_tax}}</span>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$product->total_price}}</span>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$product->total_price_with_tax}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @endif


    <div class="row invoice-sales-total-wrapper mt-3">
        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
            <p class="card-text mb-0"><span class="fw-bold">Staff in charge:</span> <span class="ms-75">{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</span></p>
        </div>
        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
            <div class="invoice-total-wrapper">
                <p style="font-weight: bold">SERVICES SUMMATION</p>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Total:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$invoice->services_total_price}}</p>
                </div>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Tax:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$settings->currency->currency_symbol}}{{$totalServiceTax}}</p>
                </div>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Payable:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$invoice->services_total_price + $totalServiceTax}}</p>
                </div>
                <hr class="my-50" />


                <p style="font-weight: bold">PRODUCTS SUMMATION</p>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Total:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$invoice->products_total_price}}</p>
                </div>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Tax:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$settings->currency->currency_symbol}}{{$totalProductTax}}</p>
                </div>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">Payable:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{$invoice->products_total_price + $totalProductTax}}</p>
                </div>

                <hr class="my-50" />
                <p style="font-weight: bold">TOTAL</p>
                <div class="invoice-total-item">
                    <p class="invoice-total-title">TO BE PAID:</p>
                    <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{($invoice->products_total_price + $totalProductTax) + ($invoice->services_total_price + $totalServiceTax)}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-2" />

    <div class="row">
        <div class="col-12">
            <span class="fw-bold">Note:</span>
            <span>{{$invoice->note}}</span>
        </div>
    </div>

    @if($invoice->contactSignature)
        <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-between text-success mt-3"><span>Signature</span> </h3>

        <div>
            <img src="{{$invoice->contactSignature->SignatureImage}}" />
        </div>
        <p class="mt-2">Signed: {{ \Carbon\Carbon::parse($invoice->contactSignature->created_at)->translatedFormat(' j F Y')}}</p>
    @endif
</div>
