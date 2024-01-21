         <!-- ---- Start NavBar ----- -->
         <nav class="bg-primary hidden lg:block">
            <div class="container">
                 <div class="flex">
                     <!-- ---- All Category ----- -->
                     <div class="px-9 2xl:px-[7rem] py-4 bg-white flex items-center cursor-pointer  group relative ">
                          <span class=" text-primary ">
                           <i class="fas fa-bars"></i>
                          </span>
                      <span class="capitalize text-primary font-semibold ml-[1.52rem]">All categories</span>
  
  
       <div class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
         @forelse ($categories as $category)
                    <!-- ---- Start single category ----- -->
                    <a title="{{$category->title}}" href="#" class="px-6 py-3 flex items-center hover:bg-gray-100 transition ">
                        <span class="material-symbols-sharp text-gray-700">
                             {{$category->icon}}
                        </span>
                        <span class="ml-6 text-gray-700 text-sm font-semibold  capitalize"> {{$category->title}}</span>
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
                 <a title="title" href="{{url('/')}}" class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300" >Home</a>
                 <a title="title" href="{{url('/shop')}}" class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300" >Shop</a>
                 <a title="title" href="index.html" class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300" >About</a>
                 <a title="title" href="index.html" class="text-gray-200 hover:text-white  font-semibold  hover:border-b transition-all ease-in-out  duration-300" >Contact</a>
  
            </div>
            <div class="ml-auto">
  
                                  <!-- ---- Start Cart ----- -->
                                  <div class="px-4 py-4 text-white bg-blue-900 flex items-center cursor-pointer  group relative ">
                                     <span class="  ">
                                      <i class="fas fa-shopping-cart"></i>
                                     </span>
                                 <span class="capitalize  font-normal text-base ml-2">৳0.00(0 items)</span>
             
             
                  <div class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
                            <!-- ---- Start single category ----- -->
                            <a title="title" href="#" class="px-8 py-3 flex items-center hover:bg-gray-100 transition ">
                            <img alt="image" src="/images/icons/bed.svg" alt="category thumb" class="w-5 h-5 object-contain " />
                            <span class="ml-6 text-gray-700 text-sm font-semibold "> BedRoom</span>
                            </a>
                            <!-- ---- single category End ----- -->
             

                  </div>
             
             
             
             
             
                                </div>
             
                                 <!-- ---- Cart End ----- -->
            </div>
  
       </div>
  
                      <!-- ---- Nav Menu End ----- -->
  
                 </div>
  
            </div>
  
       </nav> 
         <!-- ---- End NavBar ----- -->