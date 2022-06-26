<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Payment Methods</h4>
    </div>
    <div class="card-body my-1 py-25">
        <div class="row gx-4">
            <div class="col-lg-6 mt-2 mt-lg-0">
                <h6 class="fw-bolder mb-2">My Card</h6>
                <div class="added-cards">
                    <div class="cardMaster rounded border p-2 mb-1">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="card-information">
                                <div class="d-flex align-items-center mb-50">
                                    <h6 class="mb-0">{{$name}}</h6>
                                    <span class="badge badge-light-primary ms-50">Primary</span>
                                </div>
                                <span class="card-number">{{$encryptedCardNumber}}</span>
                            </div>
                            <div class="d-flex flex-column text-start text-lg-end">
                                <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">
                                    <button class="btn btn-outline-primary me-75" data-bs-toggle="modal" data-bs-target="#editCard">
                                       <span class="fa fa-edit"></span> Edit
                                    </button>
                                </div>
                                <span class="mt-2">Card expires at {{$exp}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade current-modal" id="editCard" wire:ignore.self tabindex="-1" aria-labelledby="editCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="editCardTitle">Edit Card</h1>
                    <p class="text-center">Edit your saved card details</p>

                    <!-- form -->
                    <form id="editCardValidation" wire:submit.prevent="save" class="row gy-1 gx-2 mt-75">
                        <div class="col-12">
                            <label class="form-label" for="modalEditCardNumber">Card Number</label>
                            <div class="input-group input-group-merge">
                                <input id="modalEditCardNumber" name="modalEditCard" wire:model="card_number" class="form-control credit-card-mask {{$errors->has('card_number')? 'is-invalid' : '' }}" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalEditCard2" data-msg="Please enter your credit card number" />
                                <span class="input-group-text cursor-pointer p-25" id="modalEditCard2">
                                                <span class="edit-card-type"></span>
                                </span>
                            </div>
                            @error('card_number') <span style="color: crimson; font-size: 10px;">{{ "Invalid card number" }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="modalEditCardName">Name On Card</label>
                            <input type="text" id="modalEditCardName"  wire:model.lazy="name" class="form-control {{$errors->has('name')? 'is-invalid' : '' }}" placeholder="John Doe" />
                            @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-6 col-md-3">
                            <label class="form-label" for="modalEditCardExpiryDate">Exp. Date</label>
                            <input type="date" id="modalEditCardExpiryDate"  wire:model.lazy="exp" class="form-control expiry-date-mask {{$errors->has('exp')? 'is-invalid' : '' }}" placeholder="MM/YY" />
                            @error('exp') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-6 col-md-3">
                            <label class="form-label" for="modalEditCardCvv">CVV</label>
                            <input type="text" id="modalEditCardCvv" wire:model.lazy="cvv"  class="form-control cvv-code-mask {{$errors->has('cvv')? 'is-invalid' : '' }}" maxlength="3" placeholder="654" />
                            @error('cvv') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit"  wire:loading.remove wire:target="save"  class="btn btn-primary me-1 mt-1">Save card</button>
                            <button type="button" disabled  wire:loading wire:target="save"  class="btn btn-primary me-1 mt-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
