<div class="modal fade" wire:ignore.self id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">UpdateContact</h1>
                    <p>Update contact/customer information.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateContact">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Title</label>
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
                        <label class="form-label" for="basic-icon-default-fullname">lastname</label>
                        <input type="text" wire:model.lazy="lastname" class="form-control dt-full-name  {{$errors->has('lastname')? 'is-invalid' : '' }}"  placeholder="Lastname" />
                        @error('lastname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">firstname</label>
                        <input type="text" wire:model.lazy="firstname" class="form-control dt-full-name  {{$errors->has('first')? 'is-invalid' : '' }}"  placeholder="Firstname" />
                        @error('firstname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
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
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Fax</label>
                        <input type="text" wire:model.lazy="fax"  class="form-control dt-email  {{$errors->has('fax')? 'is-invalid' : '' }}" placeholder="FAX" >
                        @error('fax') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Primary email</label>
                        <input type="email" wire:model.lazy="primary_email"  class="form-control dt-email  {{$errors->has('primary_email')? 'is-invalid' : '' }}" placeholder="Primary email" >
                        @error('primary_email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">date of birth</label>
                        <input type="date" wire:model.lazy="date_of_birth"  class="form-control dt-email  {{$errors->has('date_of_birth')? 'is-invalid' : '' }}" placeholder="Date of birth">
                        @error('date_of_birth') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-contact">Country</label>
                        <input type="text" wire:model.lazy="country"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('country')? 'is-invalid' : '' }}" placeholder="Nationality"/>
                        @error('country') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">State</label>
                        <input type="text" wire:model.lazy="state"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('state')? 'is-invalid' : '' }}" placeholder="State"/>
                        @error('state') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">City</label>
                        <input type="text" wire:model.lazy="city"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('city')? 'is-invalid' : '' }}" placeholder="City"/>
                        @error('city') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Address</label>
                        <input type="text" wire:model.lazy="address"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('address')? 'is-invalid' : '' }}" placeholder="Address"/>
                        @error('address') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Contact image</label>
                        <input type="file" wire:model.lazy="image"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('image')? 'is-invalid' : '' }}"/>
                        @error('image') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Purchased product</label>
                        <select wire:model.lazy="product" multiple  class="select2 form-select">
                            <option value="">Select product</option>
                            @if($products)
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('product') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Purchased service</label>
                        <select wire:model.lazy="service" multiple class="select2 form-select">
                            <option value="">Select service</option>
                            @if($services)
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('service') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="basic-icon-default-company">Contact description</label>
                        <textarea class="form-control" placeholder="description" wire:model.lazy="description"></textarea>
                        @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input {{$errors->has('available')? 'is-invalid' : '' }}" wire:model.lazy="available" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me"> Available </label>
                        </div>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="updateContact"  class="btn btn-primary me-1">update contact</button>
                        <button type="submit"  wire:loading wire:target="updateContact"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
