<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
     @include('layouts.title-meta', ['title' => $page_title ?? ''])
        @stack('meta')

        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- icon -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
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
          <div class="text-2xl" >
               <i class="fas fa-home"></i>
          </div>
          <div class="text-xs leading-3">Home</div>
     </NuxtLink>

     <button ref="menuBar" @click="isMobileMenuOpen = true" id="menuBar" class="flex flex-col items-center justify-center text-gray-700 hover:text-primary transition relative">
<svg class="w-6 h-6 text-2xl text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
<path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
</svg>
<div class="text-xs leading-3 mt-2">Category</div>
</button>



     <nuxt-link to="/checkout" class="block text-center text-gray-700 hover:text-primary transition relative ">
          <span
               class="absolute -right-3  -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs ">
               0
          </span>
          <div class="text-2xl">
               <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="text-xs leading-3">Cart</div>
     </nuxt-link>

</div>

<!-- ----End Mobile Menu Bar ----- -->

<!-- ---- Mobile Side Bar ----- -->

<div id="mobileMenu"
 class="fixed left-0 overflow-auto  top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow hidden" id="mobileMenu">
 <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
      <div id="closeMenu" @click="isMobileMenuOpen =false"
           class="text-gray-400 hover:text-primary text-lg absolute right-3 top-3 cursor-pointer ">
           <i class="fas fa-times"></i>
      </div>
      <h3 class="text-xl font-semibold text-white mb-2 font-roboto pl-4 pt-4 pb-4 bg-primary ">Categories</h3>
      <div class="divide-y divide-gray-300">
           {{-- <nuxt-link v-for="category in categories" :key="category.id" to="/" class="block px-4 py-4 font-medium transition hover:bg-gray-200 capitalize">
                {{category.title}}
           </nuxt-link> --}}

           <!-- <nuxt-link v-if="auth.loggedIn" to="/admin" class="block px-4 py-4 font-medium transition hover:bg-gray-200 ">
                Admin
           </nuxt-link>
           <nuxt-link v-else to="/auth/login" class="block px-4 py-4 font-medium transition hover:bg-gray-200 ">
                Login
           </nuxt-link> -->
      </div>

 </div>

</div>

<!-- ---- End Mobile Side Bar ----- -->
        <div class="font-sans text-gray-900 antialiased">
            @yield('content')
        </div>


            <!-- ---- Start Footer  ----- -->


@include('frontend.partials.footer')
<!-- ---- End Footer   ----- -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
             // Set CSRF token globally for AJAX requests
             $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

 


        $(document).ready(function () {
            
            $('.update-cart').on('click', function () {
                var productId = $(this).data('product-id');
                var quantity = $(this).closest('tr').find('.quantity').val();

                $.ajax({
                    url: '/cart/update/' + productId,
                    type: 'PATCH',
                    data: { quantity: quantity },
                    success: function (response) {
                        alert(response.message);
                    }
                });
            });

        });
</script>
@stack('custom-script')
    </body>
</html>
