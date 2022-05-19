<div class="row invoice-add">
    <form wire:submit.prevent="generateInvoice">
        <!-- Invoice Add Left starts -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <!-- Header starts -->
                <div class="card-body invoice-padding pb-0">
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
                                                <path class="text-primary" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                <path d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                <polygon fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <h3 class="text-primary invoice-logo">Binutu</h3>
                            </div>
                            <p class="card-text mb-25 w-50">{{Auth::user()->company->address}}</p>
                            <p class="card-text mb-25">{{Auth::user()->company->city}}, {{Auth::user()->company->state}}, {{Auth::user()->company->country}}</p>
                            <p class="card-text mb-0">{{Auth::user()->company->phone}}, {{Auth::user()->company->email}}</p>
                        </div>



                        <div class="invoice-number-date mt-md-0 mt-2">
                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                <h4 class="invoice-title">Invoice</h4>
                                <div class="input-group input-group-merge invoice-edit-input-group">
                                    <div class="input-group-text">
                                        <i data-feather="hash"></i>
                                    </div>
                                    <input type="text" disabled wire:model.lazy="invoice_number" class="form-control invoice-edit-input" placeholder="53634" />
                                </div>
                                @error('invoice_number') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="title">Date:* </span>
                                <input type="date" wire:model.lazy="date_issued" class="form-control invoice-edit-input date-picker {{$errors->has('date_issued')? 'is-invalid' : '' }}" />
                                @error('date_issued') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                            </div>
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
                                            <option value="{{$contact->id}}">{{$contact->user->lastname. ' '.$contact->user->firstname }}</option>
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
                            <th class="py-1">Total Price</th>
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
                                <span class="fw-bold">₦{{$p_item['unit_price']}}</span>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">{{$p_item['quantity']}}</span>
                            </td>
                            <td class="py-1">
                                <span class="fw-bold">₦{{$p_item['total_price']}}</span>
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
                                                <p class="card-text col-title mb-md-2 mb-0">Unit price(Naira)*</p>
                                                <input type="number" disabled wire:model.lazy="product_unit_price" class="form-control {{$errors->has('product_unit_price')? 'is-invalid' : '' }}" placeholder="Unit price" />
                                                @error('product_unit_price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                <p class="card-text col-title mb-md-50 mb-0">Total price(Naira)*</p>
                                                <p class="card-text mb-0">₦{{$product_total_price}}</p>
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
                                <button type="button" wire:click="addProductItem" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                    <i  wire:loading.remove wire:target="addProductItem" class="me-25 fa fa-plus"></i>
                                    <span class="spinner-border spinner-border-sm" wire:loading wire:target="addProductItem" role="status" aria-hidden="true"></span>
                                    <span class="align-middle">Add Item</span>
                                </button>
                            </div>
                        </div>
                </div>
                <!-- Product Details ends -->


                <hr class="invoice-spacing mt-0" />


                @if(count($service_selected_items) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="py-1">Service description</th>
                                <th class="py-1">Rate</th>
                                <th class="py-1">Price</th>
                                <th class="py-1">Volume</th>
                                <th class="py-1">Total</th>
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
                                        <span class="fw-bold">{{$s_item['usage']}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">₦{{$s_item['unit_price']}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$s_item['volume']}}</span>
                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">₦{{$s_item['total_price']}}</span>
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

                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Usage*</p>
                                                <input type="text" disabled wire:model="service_unit" class="form-control {{$errors->has('service_unit')? 'is-invalid' : '' }}" value="1" placeholder="1" />
                                                @error('service_unit') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Unit price(Naira)*</p>
                                                <input type="number" disabled wire:model.lazy="service_unit_price" class="form-control {{$errors->has('service_unit_price')? 'is-invalid' : '' }}" placeholder="Unit price" />
                                                @error('service_unit_price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                <p class="card-text col-title mb-md-2 mb-0">Volume needed*</p>
                                                <input type="number" wire:model="service_volume" class="form-control {{$errors->has('service_volume')? 'is-invalid' : '' }}" value="1" placeholder="1" />
                                                @error('service_volume') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-lg-5 col-12 mt-lg-0 mt-4 ">
                                                <p class="card-text col-title mb-md-50 mb-0">Total price(Naira) ₦{{$service_total_price}}</p>
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
                                <h6 class="invoice-to-title">Sales person:*</h6>
                                <div class="invoice-customer">
                                    <select wire:model.lazy="worker" class="invoiceto form-select {{$errors->has('worker')? 'is-invalid' : '' }}">
                                        <option value="">Select user in charge</option>
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
                            <div class="mt-2 mb-1">
                                <p class="mb-50">Accept payments via*</p>
                                <select multiple wire:model.lazy="payment_methods" class="form-select {{$errors->has('payment_methods')? 'is-invalid' : '' }}">
                                    <option value="Bank Account">Bank Account</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="UPI Transfer">Bank Transfer</option>
                                </select>
                                @error('payment_methods') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                            </div>
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
</div>
