         <!-- ---- Start NavBar ----- -->
         <nav class="bg-primary-light hidden lg:block">
             <div class="container">
                 <div class="flex">
                     <!-- ---- All Category ----- -->
                     <div class="px-9 2xl:px-[7rem] py-4 bg-white dark:bg-gray-800 flex items-center cursor-pointer  group relative ">
                         <span class=" text-primary-light dark:text-white ">
                             <i class="fas fa-bars"></i>
                         </span>
                         <span class="capitalize text-primary-light dark:text-white font-semibold ml-[1.52rem]">All categories</span>
                         <div
                             class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
                             @forelse ($categories as $category)
                                 <!-- ---- Start single category ----- -->
                                 <a title="{{ $category->title }}" href="#"
                                     class="px-6 py-3 flex items-center hover:bg-gray-100 transition duration-500 ease-in-out ">
                                     <span class="material-symbols-sharp text-gray-700">
                                         {{ $category->icon }}
                                     </span>
                                     <span class="ml-6 text-gray-700 text-sm font-semibold  capitalize">
                                         {{ $category->title }}</span>
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
                             <a title="title" href="{{ url('/') }}"
                                 class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300">Home</a>
                             <a title="title" href="{{ url('/shop') }}"
                                 class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300">Shop</a>
                             <a title="title" href="index.html"
                                 class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300">About</a>
                             <a title="title" href="index.html"
                                 class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300">Contact</a>

                         </div>


                         <div class="ml-auto">

                             <!-- ---- Start Cart ----- -->
                             <div class="px-4 py-4 text-white bg-blue-900 flex items-center cursor-pointer  group relative "
                                 data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                                 data-drawer-placement="right" aria-controls="drawer-right-example">
                                 <span class="  ">
                                     <i class="fas fa-shopping-cart"></i>
                                 </span>
                                 <span class="capitalize  font-normal text-base ml-2">{{ formatCurrency(0.0) }}(0
                                     items)</span>


                                 <div
                                     class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
                                     <!-- ---- Start single category ----- -->
                                     <a title="title" href="#"
                                         class="px-8 py-3 flex items-center hover:bg-gray-100 transition ">
                                         <img alt="image" src="/images/icons/bed.svg" alt="category thumb"
                                             class="w-5 h-5 object-contain " />
                                         <span class="ml-6 text-gray-700 text-sm font-semibold "> BedRoom</span>
                                     </a>
                                     <!-- ---- single category End ----- -->


                                 </div>




                             </div>

                             <!-- ---- Cart End ----- -->
                         </div>
                         <button id="theme-toggle" type="button"
                             class="text-gray-500 dark:text-yellow-300 rounded-lg text-sm p-2.5">
                             <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                             </svg>
                             <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                     fill-rule="evenodd" clip-rule="evenodd"></path>
                             </svg>
                         </button>

                     </div>

                     <!-- ---- Nav Menu End ----- -->

                 </div>

             </div>

         </nav>
         <!-- ---- End NavBar ----- -->


         <!-- drawer component -->
         <div id="drawer-right-example"
             class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full duration-300 bg-white w-80 dark:bg-gray-800"
             tabindex="-1" aria-labelledby="drawer-right-label">
             <h5 id="drawer-right-label"
                 class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                 {{-- <svg
                     class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                     <path
                         d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                 </svg> --}}
                 <svg class="w-6 h-6 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                  </svg>
                  
                 Cart</h5>
             <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
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
             class="w-full bg-white shadow-md py-3   transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
             <!-- ---- Start single category ----- -->
             <a title="title" href="#"
                 class="px-8 py-3 flex items-center justify-between hover:bg-gray-100 transition ">
                 <img alt="image" src="/images/icons/bed.svg" alt="category thumb"
                     class="w-5 h-5 object-contain " />
                     <div>

                          <div class=" text-gray-700 text-sm font-semibold "> BedRoom</div>
                          <div class=" text-gray-700 text-sm font-semibold "> 1&nbspx&nbsp500</div>
                     </div>
                 <button class=" text-red-700 text-sm font-semibold "> <i class="fas fa-trash text-red-700"></i></button>
             </a>
             <!-- ---- single category End ----- -->

             <div class="grid grid-cols-1  mt-3 pt-4">
        
               <a href="{{Route('checkout')}}"
                   class="inline-flex items-center mx-auto px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                       xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M1 5h12m0 0L9 1m4 4L9 9" />
                   </svg></a>
           </div>
         </div>

             
         </div>
