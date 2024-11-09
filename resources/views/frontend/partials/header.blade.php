    <!-- ---- Start Header ----- -->

    <header id="header"
        class="py-1 px-2 md:pt-2 shadow-sm space-x-2  bg-white lg:dark:bg-gray-800  w-full top-0 right-0 left-0 z-50 container flex items-center justify-between">

        <!-- logo  -->
        <a title="logo" href="{{ URL::to('/') }}" class="">
            <img alt="image" src="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}"
                alt="logo" class=" max-w-64 hidden lg:inline" />
            <img alt="mobile logo" src="{{ asset(isset($settings['favicon']) ? $settings['favicon'] : '/favicon.ico') }}"
                alt="logo" class=" w-14 lg:hidden" />
        </a>

        <!-- logo end  -->
        <!-- search   -->
        <div class="w-full xl:max-w-xl  lg:flex relative  ">
            <!-- <span class="absolute left-4 top-3  lg:text-lg text-gray-400 ">
                       <i class="fas fa-search"></i>
                  </span> -->
            <input type="search" autocomplete="off" id="nav-search"
                class=" border w-full md:max-lg:border-r-0 md:border-primary-light p-2 md:p-2 md:rounded-r-none rounded-md text-xs md:text-base  focus:ring-primary-light "
                placeholder="what are you looking for..." />
            <button type="submit" title="search"
                class="lg:block hidden bg-primary-light border rounded-l-none border-primary-light text-white px-8 font-medium rounded-r-md hover:bg-primary-800  transition  duration-200 ease-in-out ">
                <i class="fas fa-search"></i>
            </button>


            <ul id="nav-search-result" style="max-height: 14rem"
                class="hidden overflow-y-auto  w-full z-20  absolute top-full left-0 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white transition  duration-200 ease-in-out">
                {{-- <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">Profile</li>
                <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Settings</li>
                <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Messages</li> --}}
                {{-- <li class="w-full px-4 py-2 rounded-b-lg">Download</li> --}}
            </ul>

        </div>

        <!-- search End  -->

        <!-- NavIcons -->

        <div class="space-x-3 flex items-center">
            <!-- <a title="title" href="#" class="md:block hidden text-center text-white md:text-gray-700 hover:text-primary-light transition relative " title="Account">
                       
                       <div class="text-xl lg:text-2xl ">
                            <i class="fas fa-user "></i>
                       </div>
                  </a>  -->

            <div class="hidden lg:inline">
                <a href="{{route('partnership')}}"
                    class="bg-primary-light border border-primary-light  text-white px-2 w-full lg:w-auto lg:px-4 py-2.5 font-medium rounded uppercase hover:bg-transparent hover:text-primary-light transition truncate text-xs inline-flex justify-center items-center">
                    BE A PARTNER WITH US
                </a>
            </div>
            <!--
                  <a title="title" href="#" class="md:block hidden text-center text-white md:text-gray-700 hover:text-primary-light transition relative " title="Cart">
                       <span class=" absolute -right-2 -top-1 w-4 h-4 lg:w-5 lg:h-5 xl:w-5 xl:h-5 rounded-full flex items-center justify-center  bg-primary-light text-white text-xs "> 5 </span>
                       <div class="text-xl lg:text-2xl">
                            <i class="fas fa-shopping-bag "></i>
                       </div>
                  </a>
   
   
                  <a title="title" href="#" class="md:block hidden text-center text-white md:text-gray-700 hover:text-primary-light transition relative " title="Account">
                       
                       <div class="text-xl lg:text-2xl ">
                            <i class="fas fa-user "></i>
                       </div>
                  </a>  -->
            <button data-drawer-target="drawer-sidebar" data-drawer-show="drawer-sidebar" aria-controls="drawer-sidebar"
                class="lg:hidden  text-center text-primary-light lg:text-gray-700 hover:scale-75 transition duration-300 ease-in-out relative "
                title="Account">

                <div class="text-xl lg:text-2xl ">
                    <i class="fas fa-bars "></i>
                </div>
            </button>

        </div>
        <!-- NavIcons End  -->



    </header>

    <!-- ---- End Header ----- -->
