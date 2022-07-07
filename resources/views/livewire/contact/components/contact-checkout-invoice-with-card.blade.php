<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="">
            <p>Your Total Amount is  {{$settings->currency->currency_name}} {{$totalProductTax + $totalServiceTax}}</p>
        </div>
        <div class="card">
            <form action="{{route('contact.checkout.invoice-credit-card')}}"  method="post" id="payment-form">
                @csrf
                <input type="hidden" value="{{$invoice->id}}" name="invoice">
                <div class="form-group">
                    <div class="card-header">
                        <label for="card-element">
                            Enter your credit card information
                        </label>
                    </div>
                    <div class="card-body">
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                        <input type="hidden" name="plan" value="" />
                    </div>
                </div>
                <div class="card-footer">
                    <button
                        id="card-button"
                        class="btn btn-dark"
                        type="submit"
                        data-secret="{{ $intent }}"
                    > Pay </button>
                </div>
            </form>
        </div>
    </div>
</div>
