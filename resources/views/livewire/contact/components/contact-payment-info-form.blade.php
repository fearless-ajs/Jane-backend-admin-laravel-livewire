<div class="content-body">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills mb-2">
                <!-- billing and plans -->
                <li class="nav-item">
                    <a class="nav-link @if($billingAddress) active @endif" href="#" wire:click="showBillingAddress">
                        <i class="font-medium-3 me-50 fa fa-map-marked"></i>
                        <span class="fw-bold">Billing Address</span>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link @if($paymentMethod) active @endif" href="#" wire:click="showPaymentMethod">--}}
{{--                        <i class="font-medium-3 me-50 fa fa-money-bill"></i>--}}
{{--                        <span class="fw-bold">Payment Card</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

            </ul>

            <!-- billing address -->
            @if($billingAddress)
            @livewire('contact-billing-address-form')
            @endif
            <!-- / billing address -->

            <!-- payment methods -->
            @if($paymentMethod)
            @livewire('contact-payment-method-form')
            @endif
            <!-- / payment methods -->

            <!--/ billing and plans -->
        </div>
    </div>

</div>
