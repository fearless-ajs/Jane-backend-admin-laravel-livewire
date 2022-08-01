<div class="content-body">
    <div class="bs-stepper checkout-tab-steps">

        <div class="bs-stepper-content">

            <div id="step-address" class="content" role="tabpanel" aria-labelledby="step-address-trigger">
                <form id="checkout-address" wire:submit.prevent="saveBillingAddress" class="list-view product-checkout">
                    <!-- Checkout Customer Address Left starts -->
                    <div class="card">
                        <div class="card-header flex-column align-items-start">
                            <h4 class="card-title">Add New Address</h4>
                            <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="companyName" class="form-label">Full Name</label>
                                        <input type="text" id="companyName" name="companyName" wire:model.lazy="fullname" class="form-control {{$errors->has('fullname')? 'is-invalid' : '' }}" placeholder="PIXINVENT" data-msg="Please enter your full name" />
                                        @error('fullname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="billingEmail" class="form-label">Billing Email</label>
                                        <input class="form-control {{$errors->has('email')? 'is-invalid' : '' }}" wire:model.lazy="email" type="text" id="billingEmail" name="billingEmail" placeholder="john.doe@example.com" data-msg="Please enter billing email" />
                                        @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="taxId" class="form-label">Tax ID</label>
                                        <input type="text" id="taxId" wire:model.lazy="tax_id" name="taxId" class="form-control {{$errors->has('tax_id')? 'is-invalid' : '' }}" placeholder="Enter Tax ID" />
                                        @error('tax_id') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="vatNumber" class="form-label">VAT Number</label>
                                        <input class="form-control {{$errors->has('vat')? 'is-invalid' : '' }}"  wire:model.lazy="vat"  type="text" id="vatNumber" name="vatNumber" placeholder="Enter VAT Number" />
                                        @error('vat') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                                        <input class="form-control account-number-mask  {{$errors->has('phone')? 'is-invalid' : '' }}" wire:model.lazy="phone"  type="text" id="mobileNumber" name="mobileNumber" placeholder="Enter Mobile Number" />
                                        @error('phone') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="add-type">Country</label>
                                        <select wire:model.lazy="country"  class="form-select {{$errors->has('country')? 'is-invalid' : '' }}">
                                            <option value="">Select country</option>
                                            <option value="Afganistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bonaire">Bonaire</option>
                                            <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Canary Islands">Canary Islands</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Channel Islands">Channel Islands</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos Island">Cocos Island</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote DIvoire">Cote DIvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Curaco">Curacao</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Ter">French Southern Ter</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Great Britain">Great Britain</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea North">Korea North</option>
                                            <option value="Korea Sout">Korea South</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau">Macau</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Midway Islands">Midway Islands</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Nambia">Nambia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherland Antilles">Netherland Antilles</option>
                                            <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                            <option value="Nevis">Nevis</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau Island">Palau Island</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Phillipines">Philippines</option>
                                            <option value="Pitcairn Island">Pitcairn Island</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of Montenegro">Republic of Montenegro</option>
                                            <option value="Republic of Serbia">Republic of Serbia</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="St Barthelemy">St Barthelemy</option>
                                            <option value="St Eustatius">St Eustatius</option>
                                            <option value="St Helena">St Helena</option>
                                            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                            <option value="St Lucia">St Lucia</option>
                                            <option value="St Maarten">St Maarten</option>
                                            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                            <option value="Saipan">Saipan</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="Samoa American">Samoa American</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Tahiti">Tahiti</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Erimates">United Arab Emirates</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Uraguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City State">Vatican City State</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                            <option value="Wake Island">Wake Island</option>
                                            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zaire">Zaire</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        @error('country') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="state" class="form-label">State</label>
                                        <input class="form-control  {{$errors->has('state')? 'is-invalid' : '' }}" wire:model.lazy="state" type="text" id="state" name="state" placeholder="Enter State" />
                                        @error('state') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="state" class="form-label">City</label>
                                        <input class="form-control  {{$errors->has('city')? 'is-invalid' : '' }}" wire:model.lazy="city" type="text" id="state" name="state" placeholder="Enter City" />
                                        @error('city') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="billingAddress" class="form-label">Billing Address</label>
                                        <input type="text" class="form-control  {{$errors->has('address')? 'is-invalid' : '' }}" wire:model.lazy="address" id="billingAddress" name="billingAddress" placeholder="Billing Address" />
                                        @error('address') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control account-zip-code {{$errors->has('zip')? 'is-invalid' : '' }}"  wire:model.lazy="zip" id="zipCode" name="zipCode" placeholder="Enter Zip Code" maxlength="6" />
                                        @error('zip') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">

                                    <button type="submit"  wire:loading.remove wire:target="saveBillingAddress"  class="btn btn-primary btn-next delivery-address">Save And Deliver Here</button>
                                    <button type="button" disabled  wire:loading wire:target="saveBillingAddress"  class="btn btn-primary btn-next delivery-address"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Customer Address Left ends -->

                    <!-- Checkout Customer Address Right starts -->
                    <div class="customer-card">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$fullname}}</h4>
                            </div>
                            <div class="card-body actions">
                                <p class="card-text mb-0">{{$address}}</p>
                                <p class="card-text">{{$phone}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Customer Address Right ends -->
                </form>
            </div>
            <!-- Checkout Customer Address Ends -->
            <!-- Checkout Payment Starts -->
            <div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
                <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
{{--                    <div class="payment-type">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header flex-column align-items-start">--}}
{{--                                <h4 class="card-title">Payment information</h4>--}}
{{--                                <p class="card-text text-muted mt-25">Make sure you have a correct payment card added to your payment information,--}}
{{--                                    Your saved payment method will be used for this transaction, <a href="{{route('contact.payment-info')}}">Click here</a> if an update is needed.</p>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <h6 class="card-holder-name my-75">{{$name}}</h6>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input type="radio" id="customColorRadio1" name="paymentOptions" class="form-check-input" checked />--}}
{{--                                    <label class="form-check-label" for="customColorRadio1">--}}
{{--                                         Debit Card {{$encryptedCardNumber}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="customer-cvv mt-1 row row-cols-lg-auto">--}}
{{--                                    <div class="col-3 d-flex align-items-center">--}}
{{--                                        <label class="mb-50 form-label" for="card-holder-cvv">Enter CVV:</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4 p-0">--}}
{{--                                        <input type="password" class="form-control mb-50 input-cvv" name="input-cvv" id="card-holder-cvv" />--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <button type="button" class="btn btn-primary btn-cvv mb-50">Continue</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <hr class="my-2" />--}}
{{--                                <ul class="other-payment-options list-unstyled">--}}
{{--                                    <li class="py-50">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input type="radio" id="customColorRadio2" name="paymentOptions" class="form-check-input" />--}}
{{--                                            <label class="form-check-label" for="customColorRadio2"> Credit / Debit / ATM Card </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="py-50">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input type="radio" id="customColorRadio5" name="paymentOptions" class="form-check-input" />--}}
{{--                                            <label class="form-check-label" for="customColorRadio5"> Cash On Delivery </label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <hr class="my-2" />--}}
{{--                                <div class="gift-card mb-25">--}}
{{--                                    <p class="card-text">--}}
{{--                                        <a href="{{route('contact.payment-info')}}" class="align-middle"> <i class="me-50 font-medium-5 fa fa-edit"></i> Update my payment info</a>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="amount-payable checkout-options">
                        <div class="card">
                            <div class="card-body">
                                {{--                                <label class="section-label form-label mb-1">Options</label>--}}
                                {{--                                <div class="coupons input-group input-group-merge">--}}
                                {{--                                    <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />--}}
                                {{--                                    <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>--}}
                                {{--                                </div>--}}
                                {{--                                <hr />--}}
                                <div class="price-details">
                                    <h6 class="price-title">Price Details</h6>
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title">Estimated Price</div>
                                            <div class="detail-amt">{{$settings->currency->currency_symbol}}{{$totalPrice}}</div>
                                        </li>
                                        {{--                                        <li class="price-detail">--}}
                                        {{--                                            <div class="detail-title">Bag Discount</div>--}}
                                        {{--                                            <div class="detail-amt discount-amt text-success">-25$</div>--}}
                                        {{--                                        </li>--}}
                                        <li class="price-detail">
                                            <div class="detail-title">Estimated Tax</div>
                                            <div class="detail-amt">{{$settings->currency->currency_symbol}}{{$totalTax}}</div>
                                        </li>
                                        {{--                                        <li class="price-detail">--}}
                                        {{--                                            <div class="detail-title">EMI Eligibility</div>--}}
                                        {{--                                            <a href="#" class="detail-amt text-primary">Details</a>--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li class="price-detail">--}}
                                        {{--                                            <div class="detail-title">Delivery Charges</div>--}}
                                        {{--                                            <div class="detail-amt discount-amt text-success">Free</div>--}}
                                        {{--                                        </li>--}}
                                    </ul>
                                    <hr />
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title detail-total">Total Price</div>
                                            <div class="detail-amt fw-bolder">{{$settings->currency->currency_symbol}}{{$totalPriceWithTax}}</div>
                                        </li>
                                    </ul>
                                    <p>Your primary debit card will be used for this transaction, you can <a href="{{route('contact.payment-method')}}">click here</a> to update your primary payment card</p>

                                    @if($card)
                                        <button wire:click="makePayment" wire:loading.remove wire:target="makePayment" type="button" class="btn btn-primary w-100 btn-next place-order">Make payment now</button>
                                        <button wire:loading wire:target="makePayment" type="button" disabled class="btn btn-primary w-100 btn-next place-order">Processing payment...</button>
                                    @else
                                        <a href="{{route('contact.payment-method')}}"  class="btn btn-primary w-100 btn-next place-order">Please update your payment details</a>

                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Checkout Payment Ends -->
            <!-- </div> -->
        </div>
    </div>

</div>
