<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12">
        <div class="card invoice-preview-card">
            <div class="card-body invoice-padding pb-0">
                <!-- Header starts -->
                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                    <div>
                        <div class="logo-wrapper">
                            <a href="{{route('admin.company-profile', $invoice->company->id)}}">
                                <h3 class="text-primary invoice-logo">{{$invoice->company->name}}</h3>
                            </a>
                        </div>
                        <p class="card-text mb-25 w-50">{{$invoice->company->address}}</p>
                        <p class="card-text mb-25">{{$invoice->company->city}}, {{$invoice->company->state}}, {{$invoice->company->country}}</p>
                        <p class="card-text mb-0">{{$invoice->company->phone}}, {{$invoice->company->email}}</p>
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
                        @if($invoice->contactInfo)
                            <h6 class="mb-25">{{$invoice->contactInfo->user->lastname. '  '.$invoice->contactInfo->user->firstname}}</h6>
                            <p class="card-text mb-25">{{$invoice->contactInfo->address}}</p>
                            <p class="card-text mb-25">{{$invoice->contactInfo->office_phone}}</p>
                            <p class="card-text mb-25">{{$invoice->contactInfo->mobile_phone}}</p>
                            <p class="card-text mb-0">{{$invoice->contactInfo->primary_email}}</p>
                        @else
                            <p class="card-text text-danger">Contact deleted, you can attache new contact</p>
                        @endif
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
            </div>
            <!-- Address and Contact ends -->

            <!-- Invoice Description starts -->


            @if(count($invoice->services) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="py-1">Service description</th>
                            <th class="py-1">Price</th>
                            <th class="py-1">Billing</th>
                            <th class="py-1">Tax</th>
                            <th class="py-1">Price</th>
                            <th class="py-1">Price + Tax</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($invoice->services as $service)
                            @if($service->catalogue)
                                <tr class="border-bottom">
                                    <td class="py-1">
                                        <p class="card-text fw-bold mb-25">{{$service->catalogue->name}}</p>
                                        <p class="card-text text-nowrap">{{Str::limit($service->description, 60, $end='...')}}</p>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($service->unit_price)}}</span>
                                    </td>
                                    <td class="py-1">
                                        @if($service->catalogue->cycle)
                                            <span class="fw-bold">{{$service->catalogue->cycle->title}}</span>
                                        @else
                                            <span class="fw-bold text-da">Not available</span>
                                        @endif
                                    </td>



                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$service->total_tax}}</span>
                                    </td>

                                    {{--                                        <td class="py-1">--}}
                                    {{--                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['unit_price']}}</span>--}}
                                    {{--                                        </td>--}}

                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($service->total_price)}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($service->total_price_with_tax)}}</span>
                                    </td>

                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @endif

            @if(count($invoice->products) > 0)
                <div class="table-responsive">
                    <table class="table">
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
                            @if($product->catalogue)
                                <tr class="border-bottom">
                                    <td class="py-1">
                                        <p class="card-text fw-bold mb-25">{{$product->catalogue->name}}</p>
                                        <p class="card-text text-nowrap">{{Str::limit($product->description, 60, $end='...')}}</p>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($product->unit_price)}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$product->quantity}}</span>
                                    </td>

                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$product->total_tax}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($product->total_price)}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$settings->currency->currency_symbol}}{{number_format($product->total_price_with_tax)}}</span>
                                    </td>

                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @endif

            <div class="card-body invoice-padding pb-0">
                <div class="row invoice-sales-total-wrapper">
                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        <p class="card-text mb-0">
                            <span class="fw-bold">Staff in charge:</span> <span class="ms-75">{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</span>
                        </p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                        <div class="invoice-total-wrapper">
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Services:</p>
                                <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{number_format($invoice->services_total_price)}} + Tax: {{$settings->currency->currency_symbol}}{{$totalServiceTax}}</p>
                                <p class="invoice-total-amount">Total: {{$settings->currency->currency_symbol}}{{$invoice->services_total_price + $totalServiceTax}}</p>


                            </div>
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Products:</p>
                                <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{number_format($invoice->products_total_price)}}  + Tax: {{$settings->currency->currency_symbol}}{{$totalProductTax}} </p>
                                <p class="invoice-total-amount">Total: {{$settings->currency->currency_symbol}}{{$invoice->products_total_price + $totalProductTax}}</p>
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
                                <p class="invoice-total-amount">{{$settings->currency->currency_symbol}}{{number_format($invoice->products_total_price + $invoice->services_total_price)}} + Tax: {{$settings->currency->currency_symbol}}{{$totalProductTax + $totalServiceTax }} </p>
                                <p class="invoice-total-amount">PAYABLE: {{$settings->currency->currency_symbol}}{{($invoice->products_total_price + $totalProductTax) + ($invoice->services_total_price + $totalServiceTax)}}</p>
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

                @if(!$invoice->contactSignature)
                @if(Route::currentRouteName() == 'admin.company-invoice-preview')
                        <a class="btn btn-outline-success w-100 mb-75" href="{{route('admin.company-invoice-edit', $invoice->id)}}"> Edit </a>
                 @endif
                @if(Route::currentRouteName() == 'admin.invoice-preview')
                   <a class="btn btn-outline-success w-100 mb-75" href="{{route('admin.edit-invoice', $invoice->id)}}"> Edit </a>
                @endif




@endif

<p class="text-center">STATUS:
    @if($invoice->signed)
        <span class="text-success">Signed</span>
    @else
        <span class="text-danger">Unsigned</span>
    @endif
</p>

@if($invoice->contactSignature)
    <p class="text-xl font-semibold text-gray-700 flex items-center justify-between text-success" style="text-align: center !important;"><span>Signature</span> </p>
    <div>
        <img src="{{$invoice->contactSignature->SignatureImage}}" />
    </div>
    <p style="text-align: center;" class="mt-2">Signed: {{ \Carbon\Carbon::parse($invoice->contactSignature->created_at)->translatedFormat(' j F Y')}}</p>
@endif
</div>
</div>
</div>
<!-- /Invoice Actions -->
</div>
