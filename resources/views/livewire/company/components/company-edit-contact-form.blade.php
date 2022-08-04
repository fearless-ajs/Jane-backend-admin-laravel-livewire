<div class="modal fade current-modal" wire:ignore.self id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Update contact</h1>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateContact">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Title*</label>
                        <select wire:model.lazy="title"  class="select2 form-select">
                            <option value="">Select title</option>
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                        </select>
                        @error('title') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">firstname</label>
                        <input type="text" wire:model.lazy="firstname" class="form-control dt-full-name  {{$errors->has('first')? 'is-invalid' : '' }}"  placeholder="Firstname" />
                        @error('firstname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">lastname</label>
                        <input type="text" wire:model.lazy="lastname" class="form-control dt-full-name  {{$errors->has('lastname')? 'is-invalid' : '' }}"  placeholder="Lastname" />
                        @error('lastname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Office phone</label>
                        <input type="text" wire:model.lazy="office_phone"  class="form-control dt-email  {{$errors->has('office_phone')? 'is-invalid' : '' }}" placeholder="Office phone">
                        @error('office_phone') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Mobile phone</label>
                        <input type="number" wire:model.lazy="mobile_phone"  class="form-control dt-email  {{$errors->has('mobile_phone')? 'is-invalid' : '' }}" placeholder="Mobile phone">
                        @error('mobile_phone') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Organization</label>
                        <input type="text" wire:model.lazy="organization"  class="form-control dt-email  {{$errors->has('organization')? 'is-invalid' : '' }}" placeholder="Organization" >
                        @error('organization') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
{{--                    <div class="col-12 col-md-6">--}}
{{--                        <label class="form-label" for="basic-icon-default-email">Fax</label>--}}
{{--                        <input type="text" wire:model.lazy="fax"  class="form-control dt-email  {{$errors->has('fax')? 'is-invalid' : '' }}" placeholder="FAX" >--}}
{{--                        @error('fax') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Primary email</label>
                        <input type="email" wire:model.lazy="primary_email"  class="form-control dt-email  {{$errors->has('primary_email')? 'is-invalid' : '' }}" placeholder="Primary email" >
                        @error('primary_email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">date of birth*</label>
                        <input type="date" wire:model.lazy="date_of_birth"  class="form-control dt-email  {{$errors->has('date_of_birth')? 'is-invalid' : '' }}" placeholder="Date of birth">
                        @error('date_of_birth') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-contact">Country*</label>
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
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">State*</label>
                        <input type="text" wire:model.lazy="state"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('state')? 'is-invalid' : '' }}" placeholder="State"/>
                        @error('state') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">City*</label>
                        <input type="text" wire:model.lazy="city"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('city')? 'is-invalid' : '' }}" placeholder="City"/>
                        @error('city') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Address*</label>
                        <input type="text" wire:model.lazy="address"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('address')? 'is-invalid' : '' }}" placeholder="Address"/>
                        @error('address') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <small wire:loading wire:target="image" class="form-text text-muted mb-1"><i class="fa fa-spin"><i class="fa fa-spinner"></i></i>&nbsp;&nbsp; Validating image...</small>
                        <label  wire:loading.remove wire:target="image"  class="form-label" for="basic-icon-default-company">Image(Max: 2MB)</label>
                        <input type="file" wire:model.lazy="image"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('image')? 'is-invalid' : '' }}"/>
                        @error('image') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

{{--                    <div class="col-12 col-md-6">--}}
{{--                        <label class="form-label" for="basic-icon-default-fullname">Purchased product</label>--}}
{{--                        <select wire:model.lazy="product" multiple  class="select2 form-select">--}}
{{--                            <option value="">Select product</option>--}}
{{--                            @if($products)--}}
{{--                                @foreach($products as $product)--}}
{{--                                    <option value="{{$product->id}}">{{$product->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </select>--}}
{{--                        @error('product') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-md-6">--}}
{{--                        <label class="form-label" for="basic-icon-default-fullname">Purchased service</label>--}}
{{--                        <select wire:model.lazy="service" multiple class="select2 form-select">--}}
{{--                            <option value="">Select service</option>--}}
{{--                            @if($services)--}}
{{--                                @foreach($services as $service)--}}
{{--                                    <option value="{{$service->id}}">{{$service->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </select>--}}
{{--                        @error('service') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

                    <div class="col-12">
                        <label class="form-label" for="basic-icon-default-company">Contact description*</label>
                        <textarea class="form-control" placeholder="description" wire:model.lazy="description"></textarea>
                        @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input {{$errors->has('available')? 'is-invalid' : '' }}" wire:model.lazy="available" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me"> Available </label>
                        </div>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50"  wire:loading.remove wire:target="image">
                        <button type="submit"  wire:loading.remove wire:target="updateContact"  class="btn btn-primary me-1">update contact</button>
                        <button type="submit"  wire:loading wire:target="updateContact"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50"  wire:loading wire:target="image">
                        <button type="button" disabled class="btn btn-outline-secondary mt-1">Please wait...</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
