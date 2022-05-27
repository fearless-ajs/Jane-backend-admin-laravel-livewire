<div class="modal fade current-modal" wire:ignore.self id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Product</h1>
                    <p>Add new product to your store.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="addProduct">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Product name*</label>
                        <input type="text" wire:model.lazy="name" class="form-control dt-full-name  {{$errors->has('name')? 'is-invalid' : '' }}"  placeholder="Product name"/>
                        @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Brand name</label>
                        <input type="text" wire:model.lazy="brand" class="form-control dt-full-name  {{$errors->has('brand')? 'is-invalid' : '' }}"  placeholder="Brand name" />
                        @error('brand') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Unit price*</label>
                        <input type="text" wire:model.lazy="price"  class="form-control dt-email  {{$errors->has('price')? 'is-invalid' : '' }}" placeholder="Price">
                        @error('price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">VAT</label>
                        <input type="text" wire:model.lazy="vat"  class="form-control dt-email  {{$errors->has('vat')? 'is-invalid' : '' }}" placeholder="Value added tax" >
                        @error('vat') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Quantity*</label>
                        <input type="text" wire:model.lazy="quantity"  class="form-control dt-email  {{$errors->has('quantity')? 'is-invalid' : '' }}" placeholder="Available quantity" >
                        @error('quantity') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Previous price</label>
                        <input type="number" wire:model.lazy="previous_price"  class="form-control dt-email  {{$errors->has('previous_price')? 'is-invalid' : '' }}" placeholder="Previous price">
                        @error('previous_price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Category*</label>
                        @if(count($categories) > 0)
                            <select wire:model.lazy="category" class="form-select {{$errors->has('category')? 'is-invalid' : '' }}">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="form-label" style="color: red" for="basic-icon-default-email">Please create category, <a href="{{route('company.categories')}}">click here</a></p>
                        @endif
                        @error('category') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Manufacturer</label>
                        <input type="text" wire:model.lazy="manufacturer"  class="form-control  {{$errors->has('manufacturer')? 'is-invalid' : '' }}" placeholder="Product manufacturer">
                        @error('manufacturer') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="basic-icon-default-company">Product description*</label>
                        <textarea class="form-control" placeholder="description" wire:model.lazy="description"></textarea>
                        @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Money back days</label>
                        <input type="text" wire:model.lazy="money_back"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('money_back')? 'is-invalid' : '' }}" placeholder="Money back days"/>
                        @error('money_back') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Warranty month</label>
                        <input type="text" wire:model.lazy="warranty"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('warranty')? 'is-invalid' : '' }}" placeholder="How long is the warranty in months"/>
                        @error('warranty') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-12">
                        <div class="form-group" wire:ignore>
                                <label>Images <sup>max 20MB</sup></label><br>
                                <input name="images[]"  class="form-control {{$errors->has('images.*')? 'is-invalid' : '' }}" type="file" wire:model="images" multiple data-min-file-count="1" data-theme="fas">
                                @error('images') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                <small wire:loading wire:target="images" class="form-text text-muted"><i class="fa fa-spin"><i class="fa fa-spinner"></i></i>&nbsp;&nbsp; Loading preview...</small>
                            <!-- /.form-group -->
                        </div>
                        @if ($images)
                            Photo Preview:<br>
                            @foreach($images as $photo)
                                <a target="_blank" href="{{ $photo->temporaryUrl() }}" >
                                    <img src="{{ $photo->temporaryUrl() }}" style="margin-bottom: 5px; border: 1px solid white; max-width: 30%">
                                    <span wire:loading wire:target="removeImg({{$loop->index}})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </a>
                                <small style="cursor: pointer;" class="fas fa-times text-danger" wire:click.prevent="removeImg({{$loop->index}})" wire:loading.remove wire:target="removeImg({{$loop->index}})"></small>
                            @endforeach
                        @endif
                    </div>
                    @error('images.*') <span class="error">{{ $message }}</span> @enderror
                    @error('images') <span class="error">{{ $message }}</span> @enderror

                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input {{$errors->has('active')? 'is-invalid' : '' }}" wire:model.lazy="active" type="checkbox" tabindex="3" />
                            <label class="form-check-label" for="remember-me"> Active </label>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="addProduct"  class="btn btn-primary me-1">Add product</button>
                        <button type="submit"  wire:loading wire:target="addProduct"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
