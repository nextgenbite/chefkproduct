@extends('layouts.frontend')
@section('content')
<div>

    <!-- ---- Start Header ----- -->

{{-- <TopBar :cartcount="cartItemCount" :settings="settings"/> --}}
@include('frontend.partials.topbar')

    <!-- ---- End Header ----- -->


    <!-- ---- Start NavBar ----- -->
    {{-- <Navbar :categories="categories" /> --}}
    <!-- ---- End NavBar ----- -->

    <!-- ---- Mobile Menu Bar ----- -->

    {{-- <div
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
                   class="absolute -right-3  -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs ">{{
                        cartItemCount }}
              </span>
              <div class="text-2xl">
                   <i class="fas fa-shopping-bag"></i>
              </div>
              <div class="text-xs leading-3">Cart</div>
         </nuxt-link>

    </div> --}}

    <!-- ----End Mobile Menu Bar ----- -->

    <!-- ---- Mobile Side Bar ----- -->

<div id="mobileMenu" v-if="isMobileMenuOpen"
     class="fixed left-0 overflow-auto  top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow">
     <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
          <div id="closeMenu" @click="isMobileMenuOpen =false"
               class="text-gray-400 hover:text-primary text-lg absolute right-3 top-3 cursor-pointer ">
               <i class="fas fa-times"></i>
          </div>
          <h3 class="text-xl font-semibold text-white mb-2 font-roboto pl-4 pt-4 pb-4 bg-primary ">Categories</h3>
          <div class="divide-y divide-gray-300">
               <nuxt-link v-for="category in categories" :key="category.id" to="/" class="block px-4 py-4 font-medium transition hover:bg-gray-200 capitalize">
                    {{category.title}}
               </nuxt-link>

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

<slot />




    <!-- ---- Start Footer  ----- -->


    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 mt-4 hidden lg:block">
         <div class="container md:py-8">
              <div class="sm:flex sm:items-center sm:justify-between">
                   {{-- <nuxt-link to="/"  v-if="settings" class="flex items-center mb-4 sm:mb-0">
                        <NuxtImg  :src="settings?.favicon"
                             :alt="settings?.app_name" class="h-8 mr-3" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white uppercase">{{
                             settings?.app_name }}</span>
                   </nuxt-link> --}}
                   <ul
                        class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                             <nuxt-link to="/terms-condition" class="mr-4 hover:underline md:mr-6 ">Terms & Condition</nuxt-link>
                        </li>
                        <li>
                             <nuxt-link to="/privacy-policy" class="mr-4 hover:underline md:mr-6">Privacy Policy</nuxt-link>
                        </li>
                        <li>
                             <nuxt-link to="/contact" class="hover:underline">Contact</nuxt-link>
                        </li>
                   </ul>
              </div>
              <!-- <div class="ml-5 mt-2 flex space-x-5">
                     <a   :href="settings.facebook" class="text-gray-400 hover:text-gray-500" >
                         <i class="fab fa-facebook-f"></i>
                     </a>

                     <a  :href="settings.twitter" class="text-gray-400 hover:text-gray-500" >
                         <i class="fab fa-twitter"></i>
                     </a>

                     <a  :href="settings.instagram" class="text-gray-400 hover:text-gray-500" >
                         <i class="fab fa-instagram"></i>
                     </a>

                     <a  :href="settings.linkedin" class="text-gray-400 hover:text-gray-500" >
                         <i class="fab fa-linkedin-in"></i>
                     </a>

                </div> -->
              <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />

              <!-- ---- Copyright  ----- -->

              {{-- <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <nuxt-link to="/"
                        class="hover:underline capitalize">{{ settings?.app_name }}™</nuxt-link>. All Rights
                   Reserved.</span> --}}

              <!-- ---- End Copyright   ----- -->

         </div>
    </footer>


    <!-- ---- End Footer   ----- -->

</div>
@endsection