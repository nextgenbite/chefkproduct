@extends('layouts.frontend')
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
    @if ($cart)
    <form action="{{ url('/place-order') }}" method="post">
        @csrf
        <div class="container items-start grid-cols-12 gap-6 pt-4 pb-16 lg:grid ">
            <!-- ---- Shipping Address--->
            <div class="xl:col-span-6 lg:col-span-6 ">
                <form action="">
                    <label for="customerName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        Name</label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                        </span>
                        <input type="text" id="customerName"
                        name="name"
                            class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="elonmusk">
                    </div>
                    <label for="customerPhone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                <path
                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                            </svg>
                        </span>
                        <input type="text" id="customerPhone"
                        name="phone"
                            class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="01700000000">
                    </div>


                    <label for="customerAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        address</label>
                    <textarea id="customerAddress" rows="4" name="address"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter yor full address.."></textarea>



                    <label for="shipping_cost"
                        class="block  mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivary Zone</label>
                    <select id="shipping_cost"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option selected disabled>Choose a zone</option>
                        @forelse ($shipping_cost as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @empty
                        @endforelse
                    </select>

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
                                <th scope="col" class=" md:px-2 py-2 text-center">Qty</th>
                                <th scope="col" class="px-1 md:px-2 py-2">Price</th>
                                <th scope="col" class="px-1 md:px-2 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart['data'] as $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="p-2 hidden md:inline">
                                        <img src="{{ asset($item['thumbnail']) }}"
                                            class="md:w-16 md:ml-2 max-w-full max-h-full rounded" alt="{{ $item['title'] }}" />
                                    </td>
                                    <td class="px-2 md:px-3 py-1 font-semibold text-gray-900 dark:text-white text">
                                        {{ $item['title'] }}
                                    </td>
                                    <td class=" md:px-2 py-1">
                                        <div class="relative flex items-center max-w-[6rem]">
                                            <button type="button"
                                                data-product-id="{{ $item['product_id'] }}"
                                                class="decrement-cart bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-1 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="quantity-input" data-input-counter
                                                aria-describedby="helper-text-explanation" value="{{ $item['quantity'] }}"
                                                disabled
                                                class="quantity bg-gray-50 border-x-0 border-gray-300 h-6 w-10 md:h-8 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block  py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                 required />
                                            <button type="button" data-product-id="{{ $item['product_id'] }}"
                                                class="increment-cart bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-2 py-1 font-semibold text-gray-900 dark:text-white cart-price">
                                        {{ formatcurrency($item['price'] * $item['quantity']) }}
                                    </td>
                                    <td class="px-1 md:px-2 py-1">
                                        <button type="button" data-product-id="{{ $item['product_id'] }}"
                                            class="remove-from-cart text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1.5 md:p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">

                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 20">
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
                        <p class="sub-total"> {{ formatcurrency($cart['total_price']) }}</p>
                    </div>

                    <div class="flex justify-between font-medium">
                        <p>Delivery</p>
                        <p id="shipping_price">{{ formatcurrency(0) }}</p>
                    </div>
                    <div class="flex justify-between font-medium">
                        <p>Tax</p>
                        <p>0%</p>
                    </div>
                </div>

                <div class="flex justify-between my-3 font-semibold text-gray-800 uppercase">
                    <div>Total</div>
                    {{-- <h4>৳{{ parseFloat(carts.cartTotal + forms.shipping_cost).toFixed(2) }}</h4> --}}
                    <div id="total_price"> {{ formatcurrency($cart['total_price']) }}</div>
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


                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Choose Payment :</h3>
                <ul class="grid w-full gap-6 md:grid-cols-3 mb-2 text-center">
                    <li>
                        <input type="radio" name="payment_method" id="react-option" value="stripe" class="hidden peer"
                            required="">
                        <label for="react-option"
                            class="inline-flex lg:flex-col items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                {{-- <svg class="mb-2 w-6 h-6 text-sky-500" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M418.2 177.2c-5.4-1.8-10.8-3.5-16.2-5.1.9-3.7 1.7-7.4 2.5-11.1 12.3-59.6 4.2-107.5-23.1-123.3-26.3-15.1-69.2.6-112.6 38.4-4.3 3.7-8.5 7.6-12.5 11.5-2.7-2.6-5.5-5.2-8.3-7.7-45.5-40.4-91.1-57.4-118.4-41.5-26.2 15.2-34 60.3-23 116.7 1.1 5.6 2.3 11.1 3.7 16.7-6.4 1.8-12.7 3.8-18.6 5.9C38.3 196.2 0 225.4 0 255.6c0 31.2 40.8 62.5 96.3 81.5 4.5 1.5 9 3 13.6 4.3-1.5 6-2.8 11.9-4 18-10.5 55.5-2.3 99.5 23.9 114.6 27 15.6 72.4-.4 116.6-39.1 3.5-3.1 7-6.3 10.5-9.7 4.4 4.3 9 8.4 13.6 12.4 42.8 36.8 85.1 51.7 111.2 36.6 27-15.6 35.8-62.9 24.4-120.5-.9-4.4-1.9-8.9-3-13.5 3.2-.9 6.3-1.9 9.4-2.9 57.7-19.1 99.5-50 99.5-81.7 0-30.3-39.4-59.7-93.8-78.4zM282.9 92.3c37.2-32.4 71.9-45.1 87.7-36 16.9 9.7 23.4 48.9 12.8 100.4-.7 3.4-1.4 6.7-2.3 10-22.2-5-44.7-8.6-67.3-10.6-13-18.6-27.2-36.4-42.6-53.1 3.9-3.7 7.7-7.2 11.7-10.7zM167.2 307.5c5.1 8.7 10.3 17.4 15.8 25.9-15.6-1.7-31.1-4.2-46.4-7.5 4.4-14.4 9.9-29.3 16.3-44.5 4.6 8.8 9.3 17.5 14.3 26.1zm-30.3-120.3c14.4-3.2 29.7-5.8 45.6-7.8-5.3 8.3-10.5 16.8-15.4 25.4-4.9 8.5-9.7 17.2-14.2 26-6.3-14.9-11.6-29.5-16-43.6zm27.4 68.9c6.6-13.8 13.8-27.3 21.4-40.6s15.8-26.2 24.4-38.9c15-1.1 30.3-1.7 45.9-1.7s31 .6 45.9 1.7c8.5 12.6 16.6 25.5 24.3 38.7s14.9 26.7 21.7 40.4c-6.7 13.8-13.9 27.4-21.6 40.8-7.6 13.3-15.7 26.2-24.2 39-14.9 1.1-30.4 1.6-46.1 1.6s-30.9-.5-45.6-1.4c-8.7-12.7-16.9-25.7-24.6-39s-14.8-26.8-21.5-40.6zm180.6 51.2c5.1-8.8 9.9-17.7 14.6-26.7 6.4 14.5 12 29.2 16.9 44.3-15.5 3.5-31.2 6.2-47 8 5.4-8.4 10.5-17 15.5-25.6zm14.4-76.5c-4.7-8.8-9.5-17.6-14.5-26.2-4.9-8.5-10-16.9-15.3-25.2 16.1 2 31.5 4.7 45.9 8-4.6 14.8-10 29.2-16.1 43.4zM256.2 118.3c10.5 11.4 20.4 23.4 29.6 35.8-19.8-.9-39.7-.9-59.5 0 9.8-12.9 19.9-24.9 29.9-35.8zM140.2 57c16.8-9.8 54.1 4.2 93.4 39 2.5 2.2 5 4.6 7.6 7-15.5 16.7-29.8 34.5-42.9 53.1-22.6 2-45 5.5-67.2 10.4-1.3-5.1-2.4-10.3-3.5-15.5-9.4-48.4-3.2-84.9 12.6-94zm-24.5 263.6c-4.2-1.2-8.3-2.5-12.4-3.9-21.3-6.7-45.5-17.3-63-31.2-10.1-7-16.9-17.8-18.8-29.9 0-18.3 31.6-41.7 77.2-57.6 5.7-2 11.5-3.8 17.3-5.5 6.8 21.7 15 43 24.5 63.6-9.6 20.9-17.9 42.5-24.8 64.5zm116.6 98c-16.5 15.1-35.6 27.1-56.4 35.3-11.1 5.3-23.9 5.8-35.3 1.3-15.9-9.2-22.5-44.5-13.5-92 1.1-5.6 2.3-11.2 3.7-16.7 22.4 4.8 45 8.1 67.9 9.8 13.2 18.7 27.7 36.6 43.2 53.4-3.2 3.1-6.4 6.1-9.6 8.9zm24.5-24.3c-10.2-11-20.4-23.2-30.3-36.3 9.6.4 19.5.6 29.5.6 10.3 0 20.4-.2 30.4-.7-9.2 12.7-19.1 24.8-29.6 36.4zm130.7 30c-.9 12.2-6.9 23.6-16.5 31.3-15.9 9.2-49.8-2.8-86.4-34.2-4.2-3.6-8.4-7.5-12.7-11.5 15.3-16.9 29.4-34.8 42.2-53.6 22.9-1.9 45.7-5.4 68.2-10.5 1 4.1 1.9 8.2 2.7 12.2 4.9 21.6 5.7 44.1 2.5 66.3zm18.2-107.5c-2.8.9-5.6 1.8-8.5 2.6-7-21.8-15.6-43.1-25.5-63.8 9.6-20.4 17.7-41.4 24.5-62.9 5.2 1.5 10.2 3.1 15 4.7 46.6 16 79.3 39.8 79.3 58 0 19.6-34.9 44.9-84.8 61.4zm-149.7-15c25.3 0 45.8-20.5 45.8-45.8s-20.5-45.8-45.8-45.8c-25.3 0-45.8 20.5-45.8 45.8s20.5 45.8 45.8 45.8z"/></svg> --}}
                            </div>
                            <i class="fa-brands fa-cc-stripe mb-2 text-3xl text-sky-500"></i>
                            <div class="w-full text-lg font-semibold">Strip</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="payment_method" id="flowbite-option" value="paypal" class="hidden peer">
                        <label for="flowbite-option"
                            class="inline-flex lg:flex-col items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                {{-- <svg class="mb-2 text-green-400 w-6 h-6" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M356.9 64.3H280l-56 88.6-48-88.6H0L224 448 448 64.3h-91.1zm-301.2 32h53.8L224 294.5 338.4 96.3h53.8L224 384.5 55.7 96.3z"/></svg> --}}
                            </div>
                            <i class="fa-brands fa-paypal mb-2 text-3xl text-blue-800"></i>
                            <div class="w-full text-lg font-semibold">Paypal</div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="payment_method" id="angular-option" value="cash_on_delivary" class="hidden peer">
                        <label for="angular-option"
                            class="inline-flex lg:flex-col items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                {{-- <svg class="mb-2 text-red-600 w-6 h-6" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M185.7 268.1h76.2l-38.1-91.6-38.1 91.6zM223.8 32L16 106.4l31.8 275.7 176 97.9 176-97.9 31.8-275.7zM354 373.8h-48.6l-26.2-65.4H168.6l-26.2 65.4H93.7L223.8 81.5z"/></svg> --}}
                            </div>
                            <i class="fa-solid fa-money-bill mb-2 text-3xl text-green-500"></i>
                            <div class="w-full text-md font-semibold">Cash On Delivary</div>
                        </label>
                    </li>
                </ul>

     
                <button type="submit" 
                class="block w-full px-4 py-3 text-sm font-medium text-center text-white uppercase transition border rounded-md bg-primary-light border-primary-light hover:bg-transparent hover:text-primary">
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
@push('custom-script')
    <script>

        // cart-actions.js

        function updateCart(action, productId, row) {
            var quantityInput = row.find('.quantity');
            var itemPrice = row.find('.cart-price');
            var subTotal = $('.sub-total');

            $.ajax({
                type: 'post',
                url: "{{ url('/cart') }}" + '/' + action,
                data: {
                    id: productId
                },
                success: function(response) {
                    showFrontendAlert('success', response.message);
                    quantityInput.val(response.quantity);
                    itemPrice.text(response.item_price);
                    subTotal.text(response.total_price);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                }
            });
        }

        $(document).ready(function() {
            $('.increment-cart').on('click', function() {
                var productId = $(this).data('product-id');
                var row = $(this).closest('tr');
                updateCart('increment', productId, row);
            });

            $('.decrement-cart').on('click', function() {
                var productId = $(this).data('product-id');
                var row = $(this).closest('tr');
                updateCart('decrement', productId, row);
            });

            $('.remove-from-cart').on('click', function() {
                var productId = $(this).data('product-id');
                var row = $(this).closest('tr');
                var subTotal = $('.sub-total');

                var confirmation = confirm("Are you sure you want to remove this item from the cart?");
                if (confirmation) {
                    $.ajax({
                        type: 'post',
                        url: "{{ url('/cart/remove') }}",
                        data: {
                            id: productId
                        },
                        success: function(response) {
                            showFrontendAlert('success', response.message);
                            row.remove();
                            subTotal.text(response.total_price);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert("An error occurred. Please try again.");
                        }
                    });
                }
            });

            // ssr
            $('#shipping_cost').on('change', function() {
                var id = parseFloat($(this).val());
                if (!isNaN(id)) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('cart.update-shipping') }}",
                        data: {
                            id: id
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
                        }
                    });
                }
            });
            // $('#shipping_cost').on('change', function () {
            //     var selectedShippingCost = parseFloat($(this).val());
            //    var totalText = $('#total_price').text()
            //    var initialTotalPrice = parseFloat(totalText.replace('$', '').trim());

            //     if (!isNaN(selectedShippingCost)) {
            //         // Calculate the new total price
            //         var newTotalPrice = initialTotalPrice + selectedShippingCost;

            //         // Update the total price display
            //         $('#total_price').text(newTotalPrice.toFixed(2));
            //     }
            // });
        });


        // Order confirmation
        $('#orderConfirm').click(function() {
            const customerName = $('#customerName');
            const customerAddress = $('#customerAddress');
            const customerPhone = $('#customerPhone');
            const selectCourier = $('#shipping_cost option:selected');
            const payment_method = $('input[name="payment_method"]:checked');
            const coupon = $('#coupon');

            // Validate customer information
            let constantValue = 0;
            const fields = [{
                    element: customerName,
                    errorMessage: 'Please enter your name.'
                },
                {
                    element: customerAddress,
                    errorMessage: 'Please enter your address.'
                },
                {
                    element: customerPhone,
                    errorMessage: '** ফোন নাম্বার ১১ ডিজিট এর হতে হবে '
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

            if (selectCourier.val() === '') {
                selectCourier.toggleClass('has-error', true);
                // showFrontendAlert('error', 'Unsuccessful to Place order');
                alert('Unsuccessful to Place order')
                constantValue = 1;
            } else {
                selectCourier.toggleClass('has-error', false);
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
                            'payment_method': payment_method.val(),
                        },
                        success: function(data) {
                            <!-- Payment Modal-->
                            // set the modal menu element
const $targetEl = document.getElementById('payment_modal');


const modal = new Modal($targetEl);
// show the modal
modal.show();
                            $('#payment_modal_body').html(data.html);
                            

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
    </script>
@endpush
