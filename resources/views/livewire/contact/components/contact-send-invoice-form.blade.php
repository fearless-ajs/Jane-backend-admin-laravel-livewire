<div class="modal modal-slide-in fade current-modal" id="send-invoice-sidebar" wire:ignore.self aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">
                    <span class="align-middle">Send Invoice</span>
                </h5>
            </div>
            <div class="modal-body flex-grow-1">
                <form wire:submit.prevent="sendMessage">
                    <div class="mb-1">
                        <label for="invoice-from" class="form-label">From*</label>
                        <input type="text" disabled wire:model.lazy="from" class="form-control {{$errors->has('from')? 'is-invalid' : '' }} " id="invoice-from"  placeholder="company@email.com" />
                        @error('from') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-1">
                        <label for="invoice-to" class="form-label">To*</label>
                        <input type="text" disabled wire:model.lazy="to" class="form-control {{$errors->has('to')? 'is-invalid' : '' }}" id="invoice-to" value="qConsolidated@email.com" placeholder="company@email.com" />
                        @error('to') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-1">
                        <label for="invoice-subject" class="form-label">Subject*</label>
                        <input type="text" wire:model.lazy="subject" class="form-control  {{$errors->has('subject')? 'is-invalid' : '' }}" id="invoice-subject" value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                        @error('subject') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-1">
                        <label for="invoice-message" class="form-label">Message*</label>
                        <textarea class="form-control {{$errors->has('message')? 'is-invalid' : '' }}" wire:model.lazy="message" name="invoice-message" id="invoice-message" cols="3" rows="11" placeholder="Message..."></textarea>
                        @error('message') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-1">
                                        <span class="badge badge-light-primary">
                                            <i data-feather="link" class="me-25"></i>
                                            <span class="align-middle">Invoice link Attached</span>
                                        </span>
                    </div>
                    <div class="mb-1 d-flex flex-wrap mt-2">
                        <button type="submit" class="btn btn-primary me-1" wire:loading.remove wire:target="sendMessage" >Send</button>
                        <button type="button" class="btn btn-primary me-1" wire:loading wire:target="sendMessage" >Please wait <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
