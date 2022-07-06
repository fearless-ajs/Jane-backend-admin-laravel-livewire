<div class="row invoice-add">
    @if(!$company->address)
    <p style="text-align: center;">Please you need to complete your company profile. <a href="{{route('company.settings')}}"> Click here to proceed</a></p>
    @elseif(!$company->bankingInfo->account_number)
        <p style="text-align: center;">Please you need to complete your company banking details. <a href="{{route('company.settings')}}"> Click here to proceed</a></p>
    @else
        <form wire:submit.prevent="generateInvoice">

            <!-- Invoice Add Left starts -->
            <div class="col-xl-9 col-md-8 col-12">
                <div class="card invoice-preview-card">
                    <!-- Header starts -->
                    <div class="card-body invoice-padding pb-0">
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <h3 class="text-primary invoice-logo">{{Auth::user()->company->name}}</h3>
                                </div>
                                <p class="card-text mb-25 w-50">{{Auth::user()->company->address}}</p>
                                <p class="card-text mb-25">{{Auth::user()->company->city}}, {{Auth::user()->company->state}}, {{Auth::user()->company->country}}</p>
                                <p class="card-text mb-0">{{Auth::user()->company->phone}}, {{Auth::user()->company->email}}</p>
                            </div>



                            <div class="invoice-number-date mt-md-0 mt-2">
                                <div class="d-flex align-items-center justify-content-md-end mb-1">
                                    <h4 class="invoice-title">Code: {{$invoice_number}}</h4>
                                    @error('invoice_number') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
{{--                                <div class="d-flex align-items-center mb-1">--}}
{{--                                    <span class="title">Date:* </span>--}}
{{--                                    <input type="date" wire:model.lazy="date_issued" class="form-control invoice-edit-input date-picker {{$errors->has('date_issued')? 'is-invalid' : '' }}" />--}}
{{--                                    @error('date_issued') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
{{--                                </div>--}}
                                <div class="d-flex align-items-center">
                                    <span class="title">Due Date:* </span>
                                    <input type="date" wire:model.lazy="due_date"  class="form-control invoice-edit-input due-date-picker {{$errors->has('due_date')? 'is-invalid' : '' }}" />
                                    @error('due_date') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->

                    <hr class="invoice-spacing" />

                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row row-bill-to invoice-spacing">
                            <div class="col-xl-8 mb-lg-1 col-bill-to ps-0">
                                <h6 class="invoice-to-title">Invoice To:*</h6>
                                <div class="invoice-customer">
                                    <select wire:model.lazy="to" class="invoiceto form-select">
                                        <option>Select contact </option>
                                        @if($contacts)
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}">{{$contact->lastname. ' '.$contact->firstname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('to') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 p-0 ps-xl-2 mt-xl-0 mt-2">
                                <h6 class="mb-2">Payment Details:</h6>
                                <table>
                                    <tbody>
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

                    @if(count($product_selected_items) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="py-1">Products description</th>
                                    <th class="py-1">Unit Price</th>
                                    <th class="py-1">Quantity</th>
                                    <th class="py-1">Tax</th>
                                    <th class="py-1">Price</th>
                                    <th class="py-1">Price + Tax</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_selected_items as $p_item)
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text fw-bold mb-25">{{$p_item['name']}}</p>
                                            <p class="card-text text-nowrap">
                                                {{Str::limit($p_item['note'], 50, $end='...')}}
                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$p_item['unit_price']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$p_item['quantity']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$p_item['unit_tax']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$p_item['total_price']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$p_item['total_price_with_tax']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fa fa-trash" style="cursor:pointer;" wire:click="removeProduct({{$loop->index}})"></span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif

                <!-- Product Details starts -->
                    <div class="card-body invoice-padding invoice-product-details">
                        <div data-repeater-list="group-a">
                            <div class="repeater-wrapper" data-repeater-item>
                                <div class="row">
                                    <div class="col-12 d-flex product-details-border position-relative pe-0">
                                        <div class="row w-100 pe-lg-0 pe-1 py-2">
                                            <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                <p class="card-text col-title mb-md-50 mb-0">Item*</p>
                                                <select wire:model="product_item" class="form-select item-details">
                                                    <option value="">Select Item</option>
                                                    @if($products)
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                                <textarea  wire:model.lazy="product_item_note" class="form-control mt-2 {{$errors->has('product_item_note')? 'is-invalid' : '' }}" rows="1" placeholder="Description(Required)..."></textarea>
                                                @error('product_item_note') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Qty*</p>
                                                <input type="number" wire:model="product_quantity" class="form-control {{$errors->has('product_quantity')? 'is-invalid' : '' }} @if ($product_quantity_error) is-invalid @endif " value="1" placeholder="1" />
                                                @error('product_quantity') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Unit price({{$settings->currency->currency_symbol}})*</p>
                                                <input type="number" disabled wire:model.lazy="product_unit_price" class="form-control {{$errors->has('product_unit_price')? 'is-invalid' : '' }}" placeholder="Unit price" />
                                                @error('product_unit_price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>


                                            <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                <p class="card-text col-title mb-md-50 mb-0">Total: {{$settings->currency->currency_symbol}}{{$product_total_price}}</p>
                                                <p class="card-text mb-0">With tax: {{$settings->currency->currency_symbol}}{{$product_total_price_with_tax}} <small>({{$product_unit_tax}}%)</small> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 px-0">
                                <button type="button" wire:click="addProductItem" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                    <i  wire:loading.remove wire:target="addProductItem" class="me-25 fa fa-plus"></i>
                                    <span class="spinner-border spinner-border-sm" wire:loading wire:target="addProductItem" role="status" aria-hidden="true"></span>
                                    <span class="align-middle">Add Item</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details ends -->

                    @if(count($service_selected_items) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="py-1">Service description</th>
                                    <th class="py-1">Billing</th>
                                    <th class="py-1">Tax</th>
                                    <th class="py-1">Price</th>
                                    <th class="py-1">Price + Tax</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_selected_items as $s_item)
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text fw-bold mb-25">{{$s_item['name']}}</p>
                                            <p class="card-text text-nowrap">
                                                {{Str::limit($s_item['note'], 50, $end='...')}}
                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$s_item['cycle']}}</span>
                                        </td>


                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['unit_tax']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['unit_price']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['total_price']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$settings->currency->currency_symbol}}{{$s_item['total_price_with_tax']}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fa fa-trash" style="cursor:pointer;" wire:click="removeService({{$loop->index}})"></span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                @endif

                <!-- Product Details starts -->
                    <div class="card-body invoice-padding invoice-product-details">
                        <div data-repeater-list="group-a">
                            <div class="repeater-wrapper" data-repeater-item>
                                <div class="row">
                                    <div class="col-12 d-flex product-details-border position-relative pe-0">
                                        <div class="row w-100 pe-lg-0 pe-1 py-2">
                                            <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                <p class="card-text col-title mb-md-50 mb-0">Service*</p>
                                                <select wire:model="service_item" class="form-select item-details">
                                                    <option value="">Select Service</option>
                                                    @if($services)
                                                        @foreach($services as $service)
                                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                                <textarea  wire:model.lazy="service_item_note" class="form-control mt-2 {{$errors->has('service_item_note')? 'is-invalid' : '' }} mb-2" rows="1" placeholder="Description(Required)..."></textarea>
                                                @error('service_item_note') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Price({{$settings->currency->currency_symbol}})*</p>
                                                <input type="number" disabled wire:model.lazy="service_unit_price" class="form-control {{$errors->has('service_unit_price')? 'is-invalid' : '' }}" placeholder="Unit price" />
                                                @error('service_unit_price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Billing</p>
                                                <input type="text" wire:model="cycle" disabled class="form-control {{$errors->has('billing')? 'is-invalid' : '' }}"  />
                                                @error('billing') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>


{{--                                            <div class="col-lg-2 col-12 mt-lg-0 mt-2">--}}
{{--                                                <p class="card-text col-title mb-md-50 mb-0">Total: {{$settings->currency->currency_symbol}}{{$product_total_price}}</p>--}}
{{--                                                <p class="card-text mb-0">With tax: {{$settings->currency->currency_symbol}}{{$product_total_price_with_tax}} <small>({{$product_unit_tax}}%)</small> </p>--}}
{{--                                            </div>--}}

                                            <div class="col-lg-5 col-12 mt-lg-0 mt-4 ">
                                                <p class="card-text col-title mb-md-50 mb-0">Total: {{$settings->currency->currency_symbol}}{{$service_total_price}}</p>
                                                <p class="card-text mb-0">With tax: {{$settings->currency->currency_symbol}}{{$service_total_price_with_tax}} <small>({{$service_unit_tax}}%)</small> </p>
                                            </div>
                                        </div>
                                        <div class="
                                                d-flex
                                                flex-column
                                                align-items-center
                                                justify-content-between
                                                border-start
                                                invoice-product-actions
                                                py-50
                                                px-25
                                              ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12 px-0">
                                <button type="button" wire:click="addServiceItem" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                    <i  wire:loading.remove wire:target="addServiceItem" class="me-25 fa fa-plus"></i>
                                    <span class="spinner-border spinner-border-sm" wire:loading wire:target="addServiceItem" role="status" aria-hidden="true"></span>
                                    <span class="align-middle">Add Service</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details ends -->


                    <hr class="invoice-spacing mt-0" />

                    <div class="card-body invoice-padding pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="mt-2 mb-1">
                                    <h6 class="invoice-to-title">Designated staff:*</h6>
                                    <div class="invoice-customer">
                                        <select wire:model.lazy="worker" class="invoiceto form-select {{$errors->has('worker')? 'is-invalid' : '' }}">
                                            <option value="">-- Select --</option>
                                            @if($workers)
                                                @foreach($workers as $worker)
                                                    <option value="{{$worker->id}}">{{$worker->user->lastname. ' '.$worker->user->firstname }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('worker') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body invoice-padding py-0">
                        <!-- Invoice Note starts -->
                        <div class="row">
                            <div class="col-12">
{{--                                <div class="mt-2 mb-1">--}}
{{--                                    <p class="mb-50">Accept payments via*</p>--}}
{{--                                    <select multiple wire:model.lazy="payment_methods" class="form-select {{$errors->has('payment_methods')? 'is-invalid' : '' }}">--}}
{{--                                        <option value="Bank Account">Bank Account</option>--}}
{{--                                        <option value="Paypal">Paypal</option>--}}
{{--                                        <option value="UPI Transfer">Bank Transfer</option>--}}
{{--                                    </select>--}}
{{--                                    @error('payment_methods') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
{{--                                </div>--}}
                                <div class="mb-2">
                                    <label for="note" class="form-label fw-bold">Note:*</label>
                                    <textarea wire:model.lazy="invoice_note" class="form-control {{$errors->has('invoice_note')? 'is-invalid' : '' }}" rows="2" id="note" placeholder="Drop a note on the invoice"></textarea>
                                    @error('invoice_note') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>




                </div>
            </div>
            <!-- Invoice Add Left ends -->

            <!-- Invoice Add Right starts -->
            <div class="col-xl-3 col-md-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="demo-inline-spacing mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" wire:model="status" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="send" checked />
                                <label class="form-check-label" for="inlineRadio1">Send Invoice</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" wire:model="status" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="draft" />
                                <label class="form-check-label" for="inlineRadio2">Save to draft</label>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mb-75"  wire:loading wire:target="generateInvoice"  type="button" disabled>Please wait <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button class="btn btn-primary w-100 mb-75" wire:loading.remove wire:target="generateInvoice" type="submit">Generate invoice </button>

                    </div>
                </div>
            </div>
            <!-- Invoice Add Right ends -->
        </form>
    @endif

</div>
