<!-- ---- Start Footer  ----- -->
<Footer class=" bg-slate-900 pt-16 pb-12 mt-3 border-t border-gray-100 ">
     <div class="container">
          <div class="grid-cols-1 lg:grid lg:grid-cols-5 lg:gap-8 ">
               <div class="space-y-1 col-span-1 lg:col-span-2 ">
                    <img alt="image" src="{{asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}"
                         alt="{{isset($settings['app_name']) ? $settings['app_name'] : config('app.name')}} "
                         class="w-60 mx-auto lg:mx-0" />
                         <p class="text-gray-500 text-base px-3 font-roboto text-justify line-clamp-2 lg:text-left"> {{isset($settings['about']) ? $settings['about'] :
                         '' }}</p>
                    <div class="flex space-x-5 justify-center lg:justify-start ">
           
                         <a title="facebook" href="{{isset($settings['facebook']) ? $settings['facebook'] : ''}}"  class="text-blue-600 bg-white  hover:rotate-360  hover:animate-pulse transition-transform duration-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 me-2 text-center inline-flex justify-center items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <i class="fab fa-facebook-f w-4 h-4"></i>
                              </a>
                         <a title="twitter" href="{{isset($settings['twitter']) ? $settings['twitter'] : ''}}" class="text-blue-400 bg-white  transform  hover:rotate-360 hover:animate-pulse transition-transform duration-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 me-2 text-center inline-flex justify-center items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <i class="fab fa-twitter w-4 h-4"></i>
                              </a>
                         <a title="instagram" href="{{isset($settings['instagram']) ? $settings['instagram'] : ''}}" class="text-red-600 bg-white  hover:rotate-360 hover:animate-pulse transition-transform duration-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 me-2 text-center inline-flex justify-center items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <i class="fab fa-instagram w-4 h-4"></i>
                              </a>
                         <a title="linkedin" href="{{isset($settings['linkedin']) ? $settings['linkedin'] : ''}}" class="text-blue-400 bg-white  hover:rotate-360 hover:animate-pulse transition-transform duration-500  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 me-2 text-center inline-flex justify-center items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <i class="fab fa-linkedin w-4 h-4"></i>
                              </a>

                    </div>
               </div>

               <!-- ---- Footer link   ----- -->

               <div class="flex  lg:justify-between flex-col lg:flex-row  px-6 lg:col-span-3">
                    <div>
                         <div class="relative block">
                              <h3 class="mb-1 text-sm font-semibold text-gray-50 tracking-wide uppercase"> CONTACT INFO </h3>
                              <div class="absolute bottom-0 left-0 w-full h-0.5 flex">
                                  <div class="w-1/3  bg-primary-light"></div>
                                  <div class="w-2/3  bg-white"></div>
                              </div>
                          </div>
                         <div class="mt-4">
                              <div class="block">
                                   <p class="text-xs text-gray-50 hover:text-primary-light block font-semibold">Phone</p>
                                   <a title="phone" href="tel:{{isset($settings['phone']) ? $settings['phone'] : ''}}"
                                        class="text-base text-gray-500 block">{{isset($settings['phone']) ?
                                        $settings['phone'] : ''}}</p>
                              </div>
                              <div class="block">
                                   <p class="text-xs text-gray-50 hover:text-primary-light block font-semibold">Email</p>
                                   <p class="text-base text-gray-500 block">{{isset($settings['email']) ?
                                        $settings['email'] : ''}}</p>
                              </div>
                              <div class="block">
                                   <p class="text-xs text-gray-50 hover:text-primary-light block font-semibold">Address</p>
                                   <p class="text-base text-gray-500 block">{{isset($settings['address']) ?
                                        $settings['address'] : ''}}</p>
                              </div>

                         </div>
                    </div>



                    <div class="mt-12 md:mt-0">
                         <div class="relative block">
                              <h3 class="mb-1 text-sm font-semibold text-gray-50 tracking-wide uppercase"> QUICK LINK </h3>
                              <div class="absolute bottom-0 left-0 w-full h-0.5 flex">
                                  <div class="w-1/3  bg-primary-light"></div>
                                  <div class="w-2/3  bg-white"></div>
                              </div>
                          </div>
                         <div class="mt-4 space-y-4 ">
                              <a title="Store" href="{{  url('/stores')}}"
                                   class="text-base text-gray-500 capitalize hover:text-primary-light block font-semibold ">
                                   Find Our Product in these Stores
                              </a>
                              <a title="About" href="{{  url('/about-us')}}"
                                   class="text-base text-gray-500 capitalize hover:text-primary-light block font-semibold ">
                                   About
                              </a>
                              @forelse ($pages as $item)

                              <a title="{{ $item->title}}" href="{{  url('/page/'.$item->slug)}}"
                                   class="text-base text-gray-500 capitalize hover:text-primary-light block font-semibold ">
                                   {{ $item->title}}
                              </a>
                              @empty

                              <a title="title" href="#"
                                   class="text-base text-gray-500 hover:text-primary-light block font-semibold ">
                                   Terms and Conditions
                              </a>

                              @endforelse

                         </div>
                    </div>

                    <div class="mt-12 md:mt-0">
                         <div class="relative block">
                              <h3 class="mb-1 text-sm font-semibold text-gray-50 tracking-wide uppercase"> MY ACCOUNT </h3>
                              <div class="absolute bottom-0 left-0 w-full h-0.5 flex">
                                  <div class="w-1/3  bg-primary-light"></div>
                                  <div class="w-2/3  bg-white"></div>
                              </div>
                          </div>
                         <div class="mt-4 space-y-4 ">
                              <a title="Login" href="{{Route('login')}}"
                                   class="text-base text-gray-500 hover:text-primary-light block font-semibold ">
                                   Login
                              </a>
                              <a title="Account" href="#"
                                   class="text-base text-gray-500 hover:text-primary-light block font-semibold ">
                                   Account
                              </a>
                              <a title="title" href="#"
                                   class="text-base text-gray-500 hover:text-primary-light block font-semibold ">
                                   Track Order
                              </a>
                         </div>
                    </div>

               </div>

               <!-- ----End Footer link   ----- -->

          </div>

     </div>

</Footer>
<!-- ---- End Footer   ----- -->

<!-- ---- Copyright  ----- -->
<div class="bg-gray-800 py-4 ">
     <div class="container flex items-center justify-between ">
          <p class="text-white font-semibold ">© Nextgenbite 2024</p>

          <div>
               <img alt="image" src="{{asset('images/methods.png')}}" class="h-5" />
          </div>

     </div>

</div>


<!-- ---- End Copyright   ----- -->
