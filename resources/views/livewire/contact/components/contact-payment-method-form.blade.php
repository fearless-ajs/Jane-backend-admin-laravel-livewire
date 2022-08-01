<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Payment Methods</h4>
    </div>


    <div class="card-body my-1 py-25">
        <div class="row gx-4">
            <div class="col-lg-6 mt-2 mt-lg-0">
                <div class="added-cards">
                    @if(count($paymentMethods) > 0)
                        @foreach($paymentMethods as $method)
                        <div class="cardMaster rounded border p-2 mb-1">
                            <div class="d-flex justify-content-between flex-sm-row flex-column">
                                <div class="card-information">
                                    <div class="d-flex align-items-center mb-50">
                                        <h6 class="mb-0">{{$method->card->brand}}</h6>
                                        @if($primaryCard->stripe_payment_id == $method->id)
                                        <span class="badge badge-light-primary ms-50">Primary</span>
                                        @endif
                                    </div>
                                    <span class="card-number">*********{{$method->card->last4}}</span>
                                </div>
                                <div class="d-flex flex-column text-start text-lg-end">
                                    <div class="d-flex order-sm-0 order-1 mt-1 mt-sm-0">
                                        @if($primaryCard->stripe_payment_id != $method->id)
                                            <button class="btn btn-outline-primary me-75" data-bs-toggle="modal" data-bs-target="#editCard">
                                                <span class="fa fa-edit"></span> Set as primary
                                            </button>
                                        @endif
{{--                                        <button wire:click="removeCard({{$method->id}})"  class="btn btn-outline-primary me-75">--}}
{{--                                             Remove card--}}
{{--                                        </button>--}}
                                        <span wire:loading>Processing...</span>

                                    </div>
                                    <span class="mt-2">Card expires at {{$method->card->exp_month}}/{{$method->card->exp_year}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        @if(count($paymentMethods) < 1)
            <div class="col-md-6">
                <div class="alert alert-success text-center" id="message" role="alert">
                </div>
                <div id="error-message" class="alert alert-danger text-center">
                    <!-- Display error message to your customers here -->
                </div>

                <form id="payment-form" data-secret="{{$intent->client_secret}}">
                    <div id="payment-element">
                        <!-- Elements will create form elements here -->
                    </div>

                    <button id="submit" class="btn btn-primary mt-2 mb-2">Save card</button>
                </form>

            </div>
        @endif

{{--        <div class="mb-1 d-flex flex-wrap mt-2">--}}
{{--            <button type="button" wire:click="testOffSessionPayment" class="btn btn-primary me-1" wire:loading.remove wire:target="testOffSessionPayment" >Test off session</button>--}}
{{--            <button type="button" class="btn btn-primary me-1" wire:loading wire:target="testOffSessionPayment" >Please wait <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>--}}
{{--        </div>--}}
    </div>




    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{getEnv('STRIPE_PUBLISHABLE_KEY')}}');

        const options = {
            clientSecret: '{{Auth::user()->intent->client_secret}}',
            // Fully customizable with appearance API.
            appearance: {
                theme: 'night'
            },
        };

        // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 2
        const elements = stripe.elements(options);

        // Create and mount the Payment Element
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {error} = await stripe.confirmSetup({
                //`Elements` instance that was used to create the Payment Element
                elements,
                confirmParams: {
                    return_url: '{{route('contact.payment-method')}}',
                }
            });

            if (error) {
                // This point will only be reached if there is an immediate error when
                // confirming the payment. Show error to your customer (for example, payment
                // details incomplete)
                const messageContainer = document.querySelector('#error-message');
                messageContainer.textContent = error.message;
            } else {
                // Your customer will be redirected to your `return_url`. For some payment
                // methods like iDEAL, your customer will be redirected to an intermediate
                // site first to authorize the payment, then redirected to the `return_url`.
            }
        });
    </script>

            <script>
                // Initialize Stripe.js using your publishable key
                const stripe = Stripe('{{getEnv('STRIPE_PUBLISHABLE_KEY')}}');

                // Retrieve the "setup_intent_client_secret" query parameter appended to
                // your return_url by Stripe.js
                const clientSecret = new URLSearchParams(window.location.search).get(
                    {{Auth::user()->intent->client_secret}}
                );

                // Retrieve the SetupIntent
                stripe.retrieveSetupIntent(clientSecret).then(({setupIntent}) => {
                    const message = document.querySelector('#message')

                    // Inspect the SetupIntent `status` to indicate the status of the payment
                    // to your customer.
                    //
                    // Some payment methods will [immediately succeed or fail][0] upon
                    // confirmation, while others will first enter a `processing` state.
                    //
                    // [0]: https://stripe.com/docs/payments/payment-methods#payment-notification
                    switch (setupIntent.status) {
                        case 'succeeded': {
                            message.innerText = 'Success! Your payment method has been saved.';
                            break;
                        }

                        case 'processing': {
                            message.innerText = "Processing payment details. We'll update you when processing is complete.";
                            break;
                        }

                        case 'requires_payment_method': {
                            message.innerText = 'Failed to process payment details. Please try another payment method.';

                            // Redirect your user back to your payment page to attempt collecting
                            // payment again

                            break;
                        }
                    }
                });
            </script>

</div>
