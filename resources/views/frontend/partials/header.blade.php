    <!-- ---- Start Header ----- -->
    
    <header id="header" class="py-1  md:pt-2 shadow-sm bg-primary-light lg:bg-white lg:dark:bg-gray-800  w-full top-0 right-0 left-0 z-50">
        <div class="container flex items-center justify-between">
             <!-- logo  -->
             <a title="logo" href="{{URL::to('/')}}" class=" w-14 md:w-16 ">
                  <img alt="image" src="{{asset($settings->favicon)}}" alt="logo" class="w-full" /> 
             </a>
             <!-- logo end  -->
             <!-- search   -->
             <div class="w-full xl:max-w-xl lg:max-w-lg lg:flex relative  ">
                  <!-- <span class="absolute left-4 top-3  lg:text-lg text-gray-400 ">
                       <i class="fas fa-search"></i>
                  </span> -->
                  <input type="text" class=" border w-full md:max-lg:border-r-0 md:border-primary-light p-2 md:p-3 md:rounded-r-none rounded-md text-xs md:text-base  focus:ring-primary-light " placeholder="what are you looking for..." />
                  <button type="submit" title="search" class="lg:block hidden bg-primary-light border rounded-l-none border-primary-light text-white px-8 font-medium rounded-r-md hover:bg-transparent hover:text-primary-light transition  " >
                       <i class="fas fa-search"></i>
                  </button> 
                  
   
   <ul class=" hidden w-full z-20 absolute top-full left-0 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">Profile</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Settings</li>
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Messages</li>
        <li class="w-full px-4 py-2 rounded-b-lg">Download</li>
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
                  <button type="button" class="hidden  text-primary-light border border-primary-light hover:bg-primary-light hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center lg:inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                      
                       <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                          </svg>
                       <span class="sr-only">Icon description</span>
                       </button>
                       @auth
                            
                       <a title="register" href="{{Route('register')}}" class=" text-gray-800 dark:text-white hover:text-secondary transition font-semibold hidden lg:inline" > Dashboard</a>
                       @else
                       <a title="login" href="{{Route('login')}}" class=" text-gray-800 dark:text-white hover:text-secondary transition font-semibold hidden lg:inline" >Login</a>&nbsp|<a title="register" href="{{Route('register')}}" class=" text-gray-800 dark:text-white hover:text-secondary transition font-semibold hidden lg:inline" >Register</a>
                       @endauth
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
                  <a title="title" href="#" id="menuBar" class="lg:hidden  text-center text-white lg:text-gray-700 hover:scale-75 transition relative " title="Account">
                       
                       <div class="text-xl lg:text-2xl ">
                            <i class="fas fa-bars "></i> 
                       </div>
                  </a> 
   
             </div> 
              <!-- NavIcons End  -->
   
   
             </div>
             
        </header> 
   
        <!-- ---- End Header ----- -->
   
