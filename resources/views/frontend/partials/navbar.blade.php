<!-- ---- Start NavBar ----- -->
<nav class="bg-primary-light bg-opacity-10 hidden lg:block w-full top-0 right-0 left-0 z-40" id="navbar">
    <div class="container">
        <div class="flex">
            <!-- ---- All Category ----- -->
            <div
                class="px-9 2xl:px-[7rem] py-4 bg-white bg-opacity-80 dark:bg-gray-800 flex items-center cursor-pointer  group relative ">
                <span class=" text-primary-light dark:text-white ">
                    <i class="fas fa-bars"></i>
                </span>
                <span class="capitalize text-primary-light  dark:text-white font-semibold ml-[1.52rem]">All
                    categories</span>
                <div
                    class="absolute left-0 top-full text-gray-600 w-full bg-white shadow-md py-3 invisible rounded-b opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
                    @forelse ($categories as $item)
                    <!-- ---- Start single category ----- -->
                    <a title="{{ $item->title }}" href="{{ route('categories.show',$item->slug ) }}"
                        class="px-4 py-2 flex items-center  hover:bg-gray-100 transition duration-500 ease-in-out ">
                        <span class="material-symbols-sharp text-gray-700">
                            {{ $item->icon ?? 'adjust' }}
                        </span>
                        <span class="ml-3 text-gray-700 text-sm font-semibold  capitalize">
                            {{ $item->title }}</span>
                    </a>
                    <!-- ---- single category End ----- -->
                    @empty
                    <div class="text-center text-red-600"> Item Not Found</div>
                    @endforelse

                </div>
            </div>

            <!-- ---- All Category End ----- -->

            <div class="flex items-center justify-between flex-grow pl-12 ">
                <div class="flex items-center space-x-10 text-base capitalize ">
                    <a title="home" href="{{ url('/') }}"
                        class="text-primary-light hover:text-white  font-semibold  hover:border-primary-light  hover:border-b-2 transition-all ease-in-out  duration-300">Home</a>
                    <a title="shop" href="{{ url('/shop') }}"
                        class="text-primary-light hover:text-white  font-semibold  hover:border-primary-light  hover:border-b-2 transition-all ease-in-out  duration-300">Shop</a>
                    <a title="about" href="{{ url('page/about') }}"
                        class="text-primary-light hover:text-white  font-semibold  hover:border-primary-light  hover:border-b-2 transition-all ease-in-out  duration-300">About</a>
                    <a title="contact" href="{{ url('/contact') }}"
                        class="text-primary-light hover:text-white  font-semibold  hover:border-primary-light  hover:border-b-2 transition-all ease-in-out  duration-300">Contact</a>
                    <a title="home-2" href="{{ url('/home-2') }}"
                        class="text-primary-light hover:text-white  font-semibold  hover:border-primary-light  hover:border-b-2 transition-all ease-in-out  duration-300">Home-2</a>

                </div>


                <div class=" ml-auto">

                    <!-- ---- Start Cart ----- -->

                    <button id="cartButton"
                        class="flex px-3 py-4 items-center space-x-1 bg-primary-light  text-white  rounded-md"
                        data-drawer-target="drawer-right-cart" data-drawer-show="drawer-right-cart"
                        data-drawer-placement="right" aria-controls="drawer-right-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="mr-1" id="cartPrice">{{
                            formatCurrency(array_sum(array_column(session('cart')['data'] ?? [], 'price')) ?? 0) }}
                        </span>
                        <span id="cartItemCount">({{ count(session('cart')['data'] ?? []) > 0 ?
                            count(session('cart')['data']) : 0 }}
                            items)</span>
                    </button>

                    <!-- ---- Cart End ----- -->
                </div>


            </div>

            <!-- ---- Nav Menu End ----- -->

        </div>

    </div>

</nav>
<!-- ---- End NavBar ----- -->


<!-- drawer cart component -->
<div id="drawer-right-cart"
    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full duration-300 bg-white w-80 dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">

        <svg class="w-6 h-6 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
        </svg>

        Cart
    </h5>
    <button type="button" data-drawer-hide="drawer-right-cart" aria-controls="drawer-right-cart"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    <hr>

    <div class="w-full bg-white shadow-md py-3   transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
        @if (session()->has('cart') && isset(session('cart')['data']) && count(session('cart')['data']) > 0)
<table class="w-full">

    @foreach (session('cart')['data'] as $item)
    <!-- ---- Start single category ----- -->
    <tr title="{{ $item['title'] }}" 
        class="p-2 flex items-center justify-between {{$loop->last ? '' : border-b}}  border-gray-400 hover:bg-gray-200 transition">
        <td>

            <img src="{{ asset($item['thumbnail']) }}" alt="category thumb"
                class="w-6 md:w-10 ml-1 md:ml-2 max-w-full max-h-full rounded object-contain" />
        </td>
        <td class="px-2 w-40">
            <p class="text-gray-700 text-xs font-semibold truncate">{{ $item['title'] }}</p>
            <div class="text-gray-700 text-xs font-semibold">
                {{ $item['quantity'] }}&nbsp;x&nbsp;{{ formatcurrency($item['price']) }}
            </div>
        </td>
        <td>

            <button data-product-id="{{ $item['product_id'] }}" class="remove-from-cart text-red-700 text-sm font-semibold"> <i class="fas fa-trash text-red-700"></i></button>
        </td>
    </tr>

    <!-- ---- single category End ----- -->
    @endforeach
</table>
        <div class="grid grid-cols-1  mt-3 pt-4">

            <a href="{{ Route('checkout') }}"
                class="inline-flex items-center mx-auto px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg></a>
        </div>
        @else
        <p class="text-center text-red-600">Your cart is empty</p>
        @endif
    </div>


</div>