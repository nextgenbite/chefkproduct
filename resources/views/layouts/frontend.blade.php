<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')



    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    @stack('css')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
   const themeColor = '4, 87, 177'; // Assuming this is the correct format

// Update the Tailwind CSS configuration with the theme color
const customCSS = `
    :root {
        --color-primary: ${themeColor};
        --alpha-value: 1; // Define your alpha value here
    }
`;

// Create a style tag and append the custom CSS
const styleTag = document.createElement('style');
styleTag.textContent = customCSS;
document.head.appendChild(styleTag);
    </script>
</head>

<body class="min-h-screen bg-white dark:bg-gray-800 dark:text-white">

    <!-- ---- Start Header ----- -->

    {{-- <TopBar :cartcount="cartItemCount" :settings="settings"/> --}}
    @include('frontend.partials.header')

    <!-- ---- End Header ----- -->

    <!-- ---- Start NavBar ----- -->
    @include('frontend.partials.navbar')
    <!-- ---- End NavBar ----- -->

    <!-- ---- Mobile Menu Bar ----- -->

    <div
        class="fixed w-full border-t border-gray-200 shadow-sm bg-white py-3 bottom-0 left-0 flex justify-around items-center px-6 lg:hidden z-40  ">

        <NuxtLink to="/" class="block text-center text-gray-700 hover:text-primary transition relative ">
            <div class="text-2xl">
                <i class="fas fa-home"></i>
            </div>
            <div class="text-xs leading-3">Home</div>
        </NuxtLink>

        <button data-drawer-target="drawer-sidebar" data-drawer-show="drawer-sidebar" aria-controls="drawer-sidebar"
            class="flex flex-col items-center justify-center text-gray-700 hover:text-primary transition relative">
            <svg class="w-6 h-6 text-2xl text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path
                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
            </svg>
            <div class="text-xs leading-3 mt-2">Category</div>
        </button>


        <a href="javascript:void(0)" data-drawer-target="drawer-right-cart" data-drawer-show="drawer-right-cart"
            data-drawer-placement="right" aria-controls="drawer-right-cart"
            class="block text-center text-gray-700 hover:text-primary transition relative ">
            <span
                class="absolute -right-3  -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary-light text-white text-xs ">
                {{ count(session('cart')['data'] ?? []) > 0 ? count(session('cart')['data']) : 0 }}
            </span>
            <div class="text-2xl">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="text-xs leading-3">Cart</div>
        </a>

        <a href="{{ route('login') }}"
            class="flex flex-col items-center justify-center text-gray-700 hover:text-primary transition relative">

            <svg class="w-6 h-6 text-2xl text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                    clip-rule="evenodd" />
            </svg>

            <div class="text-xs leading-3 mt-2">Account</div>
        </a>


    </div>

    <!-- ----End Mobile Menu Bar ----- -->

    <!-- ---- Mobile Side Bar ----- -->

    <!-- drawer cart component -->
    <div id="drawer-right-cart"
        class="fixed top-0 right-0 z-30 h-screen p-4 overflow-y-auto transition-transform translate-x-full duration-300 bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">

            <svg class="w-6 h-6 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
            </svg>

            Cart
        </h5>
        <button type="button" data-drawer-hide="drawer-right-cart" aria-controls="drawer-right-cart"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <hr>

        <div
            class="w-full bg-white shadow-md py-3   transition duration-300 z-20 divide-y divide-gray-300 divide-dashed  ">
            @if (session()->has('cart') && isset(session('cart')['data']))

                @foreach (session('cart')['data'] as $item)
                    <!-- ---- Start single category ----- -->
                    <a title="{{ $item['title'] }}" href="#"
                        class="p-3 flex items-center justify-between hover:bg-gray-200 transition">
                        <img src="{{ asset($item['thumbnail']) }}" alt="category thumb"
                            class="w-6 md:w-10 ml-1 md:ml-2 max-w-full max-h-full rounded object-contain" />
                        <div class="px-2 w-40">
                            <p class="text-gray-700 text-xs font-semibold truncate">{{ $item['title'] }}</p>
                            <div class="text-gray-700 text-xs font-semibold">
                                {{ $item['quantity'] }}&nbsp;x&nbsp;{{ formatcurrency($item['price']) }}
                            </div>
                        </div>
                        <button class="text-red-700 text-sm font-semibold"> <i
                                class="fas fa-trash text-red-700"></i></button>
                    </a>

                    <!-- ---- single category End ----- -->
                @endforeach
            @else
            @endif
            <div class="grid grid-cols-1  mt-3 pt-4">

                <a href="{{ Route('checkout') }}"
                    class="inline-flex items-center mx-auto px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg></a>
            </div>
        </div>


    </div>

    <!-- drawer/sidebar component -->
    <div id="drawer-sidebar"
        class="fixed top-0 left-0 z-30 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 9h6m-6 3h6m-6 3h6M6.996 9h.01m-.01 3h.01m-.01 3h.01M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
            </svg>
            Navigation
        </h5>

        <button type="button" data-drawer-hide="drawer-sidebar" aria-controls="drawer-sidebar"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>



        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex  -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="w-full" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="menu-styled-tab"
                        data-tabs-target="#styled-menu" type="button" role="tab" aria-controls="menu"
                        aria-selected="false">Menu</button>
                </li>
                <li class="w-full" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="categories-styled-tab" data-tabs-target="#styled-categories" type="button"
                        role="tab" aria-controls="categories" aria-selected="false">Categories</button>
                </li>

            </ul>
        </div>
        <div id="default-styled-tab-content">
            {{-- start menue --}}
            <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-menu" role="tabpanel"
                aria-labelledby="menu-tab">




                <div class="text-sm font-medium text-gray-900  dark:text-white">
                    <a href="{{ route('frontend.home') }}" aria-current="true"
                        class="block w-full px-4 py-2 text-white bg-blue-700 border-b border-gray-200 rounded-t-lg cursor-pointer dark:bg-gray-800 dark:border-gray-600">
                        Home
                    </a>
                    <a href="{{ route('frontend.home') }}"
                        class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Shop
                    </a>
                    <a href="#"
                        class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Contact
                    </a>

                </div>


            </div>
            {{-- end menue --}}
            {{-- start categories --}}
            <div class="hidden  rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-categories" role="tabpanel"
                aria-labelledby="categories-tab">


                <div
                    class=" text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @forelse ($categories as $item)
                        <a href=""
                            class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                            <span class="material-symbols-sharp text-gray-700 me-2">
                                {{ $item->icon ?? 'adjust' }}
                            </span>
                            <span class="capitalize">{{ $item->title }}</span>
                        </a>
                    @empty
                    @endforelse

                </div>
            </div>
            {{-- end categories --}}

        </div>

    </div>


    <!-- ---- End Mobile Side Bar ----- -->
    <main class="font-sans text-gray-900 antialiased">
        @yield('content')
    </main>


    <!-- ---- Start Footer  ----- -->


    @include('frontend.partials.footer')
    <!-- ---- End Footer   ----- -->



    <script>
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            var message = "{{ Session::get('messege') }}";
            showFrontendAlert(type, message);
        @endif
        // <!--Start of Tawk.to Script-->
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6616a9c81ec1082f04e0de92/1hr48eec7';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
        // <!--End of Tawk.to Script-->

        document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('scroll', function() {
        // Detect device type dynamically on each scroll event
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        
        // Apply behavior based on scroll position and device type
        if (window.scrollY > 50) {
            if (isMobile) {
                // Apply mobile behavior
                document.getElementById('header').classList.add('fixed');
            } else {
                // Apply desktop behavior
                document.getElementById('navbar').classList.add('fixed');
                // add padding top to show content behind navbar
                var navbar_height = document.querySelector('#navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            }
        } else {
            // Remove fixed class and reset padding if scroll position <= 50
            document.getElementById('navbar').classList.remove('fixed');
            document.getElementById('header').classList.remove('fixed');
            document.body.style.paddingTop = '0';
        }
    });
});


        // Set CSRF token globally for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




        $(document).ready(function() {

            $('.update-cart').on('click', function() {
                var productId = $(this).data('product-id');
                var quantity = $(this).closest('tr').find('.quantity').val();

                $.ajax({
                    url: '/cart/update/' + productId,
                    type: 'PATCH',
                    data: {
                        quantity: quantity
                    },
                    success: function(response) {
                        alert(response.message);
                    }
                });
            });

        });
    </script>
    @stack('custom-script')
</body>

</html>
