@extends('layouts.frontend')
@section('title', 'Checkout')
@section('content')
    <!-- ---- BreadCrum ----- -->
    <div class="container py-4 flex justify-between ">
        <div class="flex gap-3 items-center ">
            <a href="{{ url('/') }}" class="text-primary-light dark:text-white text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-sm text-gray-500 ">
                <i class="fas fa-chevron-right"></i>
            </span>
            <p class="text-gray-500 font-medium">Checkout</p>
        </div>

    </div>
    <!-- ---- End BreadCrum --->

    <!-- ---- Shpping Cart Wrapper--->
    @if (isset($cartItems) && count($cartItems->items) > 0)
        <form action="{{ url('/place-order') }}" method="post" id="payment-form">
            @csrf
            <div class="container items-start grid-cols-12 gap-6 pt-4 pb-16 lg:grid ">
                <!-- ---- Shipping Address--->
                <div class="xl:col-span-6 lg:col-span-6 ">
                    <form action="">
                        <label for="customerName" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Full
                            Name</label>
                        <div class="flex mb-2">
                            <span
                                class="inline-flex items-center px-3 text-sm text-white bg-primary-light border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                                <i class="fa fa-user-circle " aria-hidden="true" style="font-size: 1.2rem"></i>
                            </span>
                            <input type="text" id="customerName" name="name" value="{{ old('name') }}"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-primary-light focus:border-primary-light block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light"
                                placeholder="Enter your name">
                        </div>
                        <label for="customerPhone"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <div class="flex mb-2">
                            <span
                                class="inline-flex items-center px-3 text-sm text-white bg-primary-light border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <i class="fa fa-phone " aria-hidden="true" style="font-size: 1.2rem"></i>
                            </span>
                            <input type="text" id="customerPhone" name="phone"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-primary-light focus:border-primary-light block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">
                        </div>
                        <label for="customerEmail"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <div class="flex mb-2">
                            <span
                                class="inline-flex items-center px-3 text-sm text-white bg-primary-light border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                                <i class="fa fa-envelope " aria-hidden="true" style="font-size: 1.2rem"></i>
                            </span>
                            <input type="text" id="customerEmail" name="email" value="{{ old('email') }}"
                                class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-primary-light focus:border-primary-light block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light"
                                placeholder="ex@gmail.com">
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 mb-2">
                            <div>
                                <label for="country"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country / Region
                                    <span class="text-red-500">*</span></label>
                                <select id="country" name="country"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-light focus:border-primary-light block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light">
                                    <option selected disabled>Choose a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('category') == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="state"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">State/Province
                                    <span class="text-red-500">*</span></label>
                                <select id="state" name="state"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-light focus:border-primary-light block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light">
                                    <option selected disabled>Select a State</option>

                                </select>
                            </div>
                            <div class="">
                                <label for="zip_code"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
                                <input type="text" id="zip_code" name="zip" value="{{ old('zip') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-light focus:border-primary-light block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light">
                            </div>
                        </div>


                        <label for="customerAddress"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Street LIne</label>
                        <textarea id="customerAddress" rows="4" name="address"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-light focus:border-primary-light dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light"
                            placeholder="3322 Belfort Ct..">{{ old('address') }}</textarea>





                    </form>
                </div>

                <!-- ---- End Shipping Address--->


                <!-- ---- Order Summary--->
                <div
                    class="px-4 py-4 mt-6 bg-gray-100 border border-gray-200 rounded shadow-md xl:col-span-6 lg:col-span-6 lg:mt-0 card">


                    <!-- ---- Product Cart--->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-xs md:text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            id="cart-table">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-2 py-3 hidden md:inline">
                                        <span class="sr-only">Image</span>
                                    </th>
                                    <th scope="col" class="px-1 md:px-2 py-2">Product</th>
                                    <th scope="col" class="px-1 md:px-2 py-2">Price</th>
                                    <th scope="col" class=" md:px-2 py-2 text-center">Qty</th>
                                    <th scope="col" class="px-1 md:px-2 py-2">Total</th>
                                    <th scope="col" class="px-1 md:px-2 py-2 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems->items as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="p-2 hidden md:inline">
                                            <img src="{{ asset($item->product->thumbnail) }}"
                                                class="md:w-16 md:ml-2 max-w-full max-h-full rounded"
                                                alt="{{ $item['title'] }}" />
                                        </td>
                                        <td class="px-2 md:px-3 py-1 font-semibold text-gray-900 dark:text-white text">
                                            {{ $item->product->title }}
                                        </td>
                                        <td class="px-2 py-1 font-semibold text-gray-900 dark:text-white">
                                            {{ formatcurrency($item->product->price) }}
                                        </td>
                                        <td class=" md:px-2 py-1">
                                            <div class="relative flex items-center max-w-[6rem]">
                                                <button type="button" data-product-id="{{ $item['product_id'] }}"
                                                    class="decrement-cart bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-1 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" id="quantity-input" data-input-counter
                                                    aria-describedby="helper-text-explanation"
                                                    value="{{ $item['quantity'] }}" disabled
                                                    class="quantity bg-gray-50 border-x-0 border-gray-300 h-6 w-10 md:h-8 text-center text-gray-900 text-sm focus:ring-primary-light focus:border-primary-light block  py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light"
                                                    required />
                                                <button type="button" data-product-id="{{ $item['product_id'] }}"
                                                    class="increment-cart bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>

                                        <td class="px-2 py-1 font-semibold text-gray-900 dark:text-white cart-price">
                                            {{ formatcurrency($item->product->price * $item['quantity']) }}
                                        </td>
                                        <td class="px-1 md:px-2 py-1">
                                            <button type="button" data-product-id="{{ $item['product_id'] }}"
                                                class="remove-from-cart text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1.5 md:p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">

                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                </svg>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- ---- End Product Cart--->


                    <h3 class="mb-4 text-lg font-medium text-gray-800 uppercase ">Order Summary</h3>

                    <div class="pb-3 space-y-1 text-gray-600 border-b border-gray-200 ">
                        <div class="flex justify-between font-medium">
                            <p>Subtotal</p>
                            <p class="sub-total"> {{ formatcurrency($cartItems->subtotal) }}</p>
                        </div>

                        <div class="flex justify-between font-medium">
                            <p>Shipping + Handling</p>
                            <p id="shipping_price">{{ formatcurrency($cartItems->shipping_cost) }}</p>
                        </div>
                        <div class="flex justify-between font-medium">
                            <p>Tax <span class="tax_percentage">0%</span></p>
                            <p>{{formatcurrency($cartItems->tax)}}</p>
                        </div>
                    </div>

                    <div class="flex justify-between my-3 font-semibold text-gray-800 uppercase">
                        <div>Total</div>
                        {{-- <h4>৳{{ parseFloat(carts.cartTotal + forms.shipping_cost).toFixed(2) }}</h4> --}}
                        <div id="total_price"> {{ formatcurrency( $cartItems->total) }}</div>
                    </div>

                    <!-- ---- Coupon --->
                    <div class="flex mb-4">
                        <input type="text"
                            class="w-full px-3 py-2 pl-4 text-sm border border-r-0 border-primary-light rounded-l-md focus:ring-primary-light focus:border-primary-light "
                            placeholder="Coupon" />

                        <button type="submit"
                            class=" bg-primary-light border border-primary-light text-white px-5 font-medium rounded-r-md hover\:bg-transparent hover\:text-primary-light transition text-sm w-1/3 block text-center ">Apply</button>

                    </div>
                    <!-- ---- End Coupon--->

                    {{-- payment --}}

                    <div class="flex ">
                        <h3 class="mb-3 text-lg font-medium text-gray-900 dark:text-white">Credit/Debit Cards :</h3>
                        <div class="inline-flex space-x-2 mt-1">
                            <img class="h-6" src="{{ asset('images/icons/amex.svg') }}" alt="amex">
                            <img class="h-6" src="{{ asset('images/icons/discover.svg') }}" alt="discover">
                            <img class="h-6" src="{{ asset('images/icons/visa.svg') }}" alt="visa">
                            <img class="h-6" src="{{ asset('images/icons/mastercard.svg') }}" alt="mastercard">
                        </div>
                    </div>


                    <div class="mb-2">
                        <label for="card-element"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Card </label>
                        <div id="card-element"
                            class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <!-- A Stripe Element will be inserted here for the card details -->
                        </div>
                        <!-- Display error messages to the customer -->
                        <div id="card-errors" class="mt-2 text-red-500 text-sm"></div>
                    </div>


                    <button type="submit"
                        class="block w-full px-4 py-3 text-sm font-medium text-center text-white uppercase transition border rounded-md bg-primary-light border-primary-light hover:bg-transparent hover:text-primary-light">
                        Place Order
                    </button>

                </div>



                <!-- ---- End Order Summary--->
            </div>
        </form>

        <!-- Payment Modal-->
        @include('frontend.partials.modal')
    @else
        <div v-else class="container pt-4 pb-16">
            <div class="flex items-center justify-center">

                <h2 class="font-mono text-3xl font-medium ">Your Cart is empty</h2>
            </div>
        </div>
    @endif

    <!-- ---- End Cart Wrapper --->
@endsection
@push('scripts')
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");

        // Create an instance of Elements
        var elements = stripe.elements();

        // Create an instance of the card Element for full card details
        var card = elements.create('card', {
            style: {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        // Mount the card element into the div with id `card-element`
        card.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display error in the `card-errors` div
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Function to handle the token received from Stripe
        function stripeTokenHandler(token) {
            // Create a hidden input to store the token and submit it
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                var countryId = $(this).val(); // Get the selected country ID

                // Clear the state dropdown
                $('#state').empty();
                $('#state').append('<option selected disabled>Select a State</option>');

                // Check if a country is selected
                if (countryId) {
                    // Find the selected country in the list of countries from Laravel
                    var countries = @json($countries); // Access countries from the backend

                    var selectedCountry = countries.find(function(country) {
                        return country.id == countryId;
                    });

                    // Populate the state dropdown with the states of the selected country
                    if (selectedCountry && selectedCountry.states.length > 0) {
                        $.each(selectedCountry.states, function(index, state) {
                            $('#state').append('<option value="' + state.name + '">' + state.name +
                                '</option>');
                        });
                    }
                }
            });

            $('input[name=zip]').change(function() {
                const country = $('#country option:selected:enabled')
                    .val(); // Get value, not the jQuery object
                const state = $('#state option:selected:enabled').val(); // Get value, not the jQuery object
                const zip = $(this).val(); // Get the value of zip input

                if (country && state && zip) { // Check if all values are present
                    $.ajax({
                        type: 'post',
                        url: "{{ url('/cart/shipping-price') }}", // Ensure URL is correct
                        data: {
                            country: country,
                            state: state,
                            zip: zip
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#shipping_price').text(response.shipping_cost);
                                $('#total_price').text(response.total_price);
                            } else {
                                console.error(response.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            // alert("An error occurred. Please try again.");
                        }
                    });
                } else {
                    alert("Please select valid country, state, and zip code.");
                }
            });

        });

        // function updateCart(action, productId, row) {
        //     const quantityInput = row.find('.quantity');
        //     const itemPrice = row.find('.cart-price');
        //     const subTotal = $('.sub-total');

        //     $.post("{{ url('/cart') }}/" + action, {
        //             id: productId
        //         })
        //         .done((response) => {
        //             showFrontendAlert('success', response.message);
        //             quantityInput.val(response.quantity);
        //             itemPrice.text(response.item_price);
        //             subTotal.text(response.subtotal);

        //             $('#shipping_price').text(response.shipping_cost);
        //             $('#total_price').text(response.total);

        //             $('#sidebar-cart').html(response.sidebar);
        //             $('#cartPrice').text(response.subtotal);
        //             $('#cartItemCount').text(`(${response.count} items)`);
        //             $('#footer_cart_icon').text(response.count);

        //         })
        //         .fail((xhr, status, error) => {
        //             console.error(error);
        //             alert("An error occurred. Please try again.");
        //         });
        // }




        // Order confirmation
        $('#orderConfirm').click(function() {
            const customerName = $('#customerName');
            const customerAddress = $('#customerAddress');
            const customerPhone = $('#customerPhone');
            const country = $('#country option:selected');
            const state = $('#state option:selected');
            // const payment_method = $('input[name="payment_method"]:checked');
            const coupon = $('#coupon');

            // Validate customer information
            let constantValue = 0;
            const fields = [{
                    element: customerName,
                    errorMessage: 'Please enter your full name.'
                },
                {
                    element: customerAddress,
                    errorMessage: 'Please enter your address.'
                },
                {
                    element: customerPhone,
                    errorMessage: 'Please enter your phone.'
                }
            ];

            fields.forEach(field => {
                if (!field.element.val()) {
                    field.element.toggleClass('has-error', true);
                    // showFrontendAlert('error', field.errorMessage);
                    alert(field.errorMessage)
                    constantValue = 1;
                } else {
                    field.element.toggleClass('has-error', false);
                }
            });

            if (!customerPhone.val() || !/^\d{11}$/.test(customerPhone.val())) {
                jQuery('.numberError').text(fields.find(field => field.element.attr('id') === 'customerPhone')
                    .errorMessage);
                constantValue = 1;
            } else {
                jQuery('.numberError').text('');
            }

            if (country.val() === '') {
                country.toggleClass('has-error', true);
                showFrontendAlert('error', 'Unsuccessful to Place order');
                constantValue = 1;
            } else {
                country.toggleClass('has-error', false);
            }

            if (constantValue === 1) {
                $('html, body').animate({
                    scrollTop: $('body').position().top
                }, 500);
            } else {
                // Check if the cart is empty
                if ($('#cart-table tbody tr').length === 0) {
                    alert('Please add some products to the cart')
                    // showFrontendAlert('error', 'Please add some products to the cart.');
                    return;
                }
                var confirmation = confirm("Are you sure you want to place an order?");
                if (confirmation) {

                    $.ajax({
                        type: 'post',
                        url: "{{ url('/place-order') }}",
                        data: {
                            'name': customerName.val(),
                            'phone': customerPhone.val(),
                            'address': customerAddress.val(),
                            'country': country,
                            'state': state,
                            'payment_method': 'stripe',
                        },
                        success: function(data) {
                            // <!--Payment Modal-- >
                            // set the modal menu element
                            // const $targetEl = document.getElementById('payment_modal');


                            // const modal = new Modal($targetEl);
                            // // show the modal
                            // modal.show();
                            // $('#payment_modal_body').html(data.html);


                            // alert(data.message)
                            showFrontendAlert('success', data.message);
                            // window.location.href = `/order-confirmed?order=${data.id}`;
                            // couponRemove_2();
                            // console.log(data.id);
                        }
                    });
                }

            }
        });

        // pixel
        @if (isset($settings['pixel_id']) && $cart)
        fbq('track', 'InitiateCheckout', {
            value: "{{ round($cart->total) }}", // Total order value
            currency: 'USD'
        });
        @endif
    </script>
@endpush
