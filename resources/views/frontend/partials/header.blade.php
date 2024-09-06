    <!-- ---- Start Header ----- -->

    <header id="header"
        class="py-1  md:pt-2 shadow-sm space-x-2  bg-primary-light bg-opacity-20 lg:bg-white lg:dark:bg-gray-800  w-full top-0 right-0 left-0 z-50 container flex items-center justify-between">

        <!-- logo  -->
        <a title="logo" href="{{ URL::to('/') }}" class="">
            <img alt="image" src="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}" alt="logo" class=" max-w-64 hidden lg:inline" />
            <img alt="mobile logo" src="{{ asset(isset($settings['favicon']) ? $settings['favicon'] : '/favicon.ico') }}" alt="logo" class=" w-14 lg:hidden" />
        </a>
       
        <!-- logo end  -->
        <!-- search   -->
        <div class="w-full xl:max-w-xl lg:max-w-lg lg:flex relative  ">
            <!-- <span class="absolute left-4 top-3  lg:text-lg text-gray-400 ">
                       <i class="fas fa-search"></i>
                  </span> -->
            <input type="search"
            autocomplete="off"
            id="nav-search"
                class=" border w-full md:max-lg:border-r-0 md:border-primary-light p-2 md:p-2 md:rounded-r-none rounded-md text-xs md:text-base  focus:ring-primary-light "
                placeholder="what are you looking for..." />
            <button type="submit" title="search"
                class="lg:block hidden bg-primary-light border rounded-l-none border-primary-light text-white px-8 font-medium rounded-r-md hover:bg-primary-800  transition  duration-200 ease-in-out ">
                <i class="fas fa-search"></i>
            </button>


            <ul
            id="nav-search-result" style="max-height: 14rem"
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
                @auth


                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-lg hover:text-primary-light dark:hover:text-primary-800 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 me-2 rounded-full capitalize"
                            src="{{ asset(auth()->user()->avatar ?: '/images/no-image.png') }}" alt="user photo">
                        {{ ucwords(auth()->user()->name) }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarName"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium ">{{ ucwords(auth()->user()->name) }}</div>
                            <div class="truncate">{{ auth()->user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    onclick="event.preventDefault();
                                                              this.closest('form').submit();"
                                    class="block px-4 w-full text-left py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Sign out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <button type="button"
                        class="hidden  text-gray-500 border border-gray-500 hover:bg-gray-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-sm p-2 text-center lg:inline-flex items-center dark:border-primary-light dark:text-primary-light dark:hover:text-white dark:focus:ring-primary-light dark:hover:bg-primary-light ">

                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                        <span class="sr-only">Icon description</span>
                    </button>
                    <a title="login" href="{{ Route('login') }}"
                        class=" text-gray-500 text-sm dark:text-white hover:text-secondary transition ">Login</a><span class="text-gray-500">&nbsp|&nbsp</span><a
                        title="register" href="{{ Route('register') }}"
                        class=" text-gray-500 text-sm dark:text-white hover:text-secondary transition  hidden lg:inline">Register</a>
                @endauth
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
            <button data-drawer-target="drawer-sidebar" data-drawer-show="drawer-sidebar"
                aria-controls="drawer-sidebar"
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
