<div class="modal fade" wire:ignore.self id="editServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Service</h1>
                    <p>Add new service to your company.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateService">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Service name</label>
                        <input type="text" wire:model.lazy="name" class="form-control dt-full-name  {{$errors->has('name')? 'is-invalid' : '' }}"  placeholder="Service name"/>
                        @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Price</label>
                        <input type="text" wire:model.lazy="price"  class="form-control dt-email  {{$errors->has('price')? 'is-invalid' : '' }}" placeholder="Price">
                        @error('price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Usage unit</label>
                        <select  wire:model.lazy="usage_unit"  class="select2 form-select {{$errors->has('usage_unit')? 'is-invalid' : '' }}" >
                            <option value="">Select usage unit</option>
                            <option value="hours">Hours</option>
                            <option value="days">Days</option>
                            <option value="incident">Incident</option>
                        </select>
                        @error('usage_unit') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Number of units</label>
                        <input type="number" wire:model.lazy="unit_number"  class="form-control dt-email  {{$errors->has('unit_number')? 'is-invalid' : '' }}" placeholder="Unit number">
                        @error('unit_number') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">VAT</label>
                        <input type="text" wire:model.lazy="vat"  class="form-control dt-email  {{$errors->has('vat')? 'is-invalid' : '' }}" placeholder="Value added tax" >
                        @error('vat') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Money back days</label>
                        <input type="text" wire:model.lazy="money_back"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('money_back')? 'is-invalid' : '' }}" placeholder="Money back days"/>
                        @error('money_back') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>


                    {{--                    <div class="col-12 col-md-6">--}}
                    {{--                        <label class="form-label" for="basic-icon-default-email">Currency</label>--}}
                    {{--                        <input type="text" wire:model.lazy="currency"  class="form-control  {{$errors->has('currency')? 'is-invalid' : '' }}" placeholder="Currency">--}}
                    {{--                        @error('currency') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror--}}
                    {{--                    </div>--}}
                    <div class="col-12">
                        <label class="form-label" for="basic-icon-default-company">Service description</label>
                        <textarea class="form-control" placeholder="description" wire:model.lazy="description"></textarea>
                        @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input {{$errors->has('active')? 'is-invalid' : '' }}" wire:model.lazy="active" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me"> Active </label>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="updateService"  class="btn btn-primary me-1">Update service</button>
                        <button type="submit"  wire:loading wire:target="updateService"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
