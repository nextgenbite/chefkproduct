<!-- ---- Start Footer  ----- -->
<Footer class=" bg-slate-200 pt-16 pb-12 mt-3 border-t border-gray-100 ">
     <div class="container">
          <div class="grid-cols-1 lg:grid lg:grid-cols-5 lg:gap-8 ">
               <div class="space-y-1 col-span-1 lg:col-span-2 ">
                    <img alt="image" src="{{asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}"
                         alt="{{isset($settings['app_name']) ? $settings['app_name'] : config('app.name')}} "
                         class="w-60 mx-auto lg:mx-0" />
                    <p class="text-gray-500 text-base font-roboto text-center lg:text-left"> {{isset($settings['about']) ? $settings['about'] :
                         '' }}</p>
                    <div class="flex space-x-5 justify-center lg:justify-start">
                         <a title="facebook" href="{{isset($settings['facebook']) ? $settings['facebook'] : ''}}"
                              class="text-gray-400 hover:text-gray-500">
                              <i class="fab fa-facebook-f"></i>
                         </a>

                         <a title="twitter" href="{{isset($settings['twitter']) ? $settings['twitter'] : ''}}"
                              class="text-gray-400 hover:text-gray-500">
                              <i class="fab fa-twitter"></i>
                         </a>

                         <a title="instagram" href="{{isset($settings['instagram']) ? $settings['instagram'] : ''}}"
                              class="text-gray-400 hover:text-gray-500">
                              <i class="fab fa-instagram"></i>
                         </a>

                         <a title="linkedin" href="{{isset($settings['linkedin']) ? $settings['linkedin'] : ''}}"
                              class="text-gray-400 hover:text-gray-500">
                              <i class="fab fa-linkedin-in"></i>
                         </a>

                    </div>
               </div>

               <!-- ---- Footer link   ----- -->

               <div class="flex  lg:justify-between flex-col lg:flex-row  px-6 lg:col-span-3">
                    <div>
                         <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase"> CONTACT INFO </h3>
                         <div class="mt-4 space-y-2">
                              <div class="block">
                                   <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Phone</p>
                                   <a title="phone" href="tel:{{isset($settings['phone']) ? $settings['phone'] : ''}}"
                                        class="text-base text-gray-500 block">{{isset($settings['phone']) ?
                                        $settings['phone'] : ''}}</p>
                              </div>
                              <div class="block">
                                   <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Email</p>
                                   <p class="text-base text-gray-500 block">{{isset($settings['email']) ?
                                        $settings['email'] : ''}}</p>
                              </div>
                              <div class="block">
                                   <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Address</p>
                                   <p class="text-base text-gray-500 block">{{isset($settings['address']) ?
                                        $settings['address'] : ''}}</p>
                              </div>

                         </div>
                    </div>



                    <div class="mt-12 md:mt-0">
                         <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase "> USEFUL LINK </h3>
                         <div class="mt-4 space-y-4 ">
                              @forelse ($pages as $item)

                              <a title="{{ $item->title}}" href="{{  url('/page/'.$item->slug)}}"
                                   class="text-base text-gray-500 capitalize hover:text-gray-900 block font-semibold ">
                                   {{ $item->title}}
                              </a>
                              @empty

                              <a title="title" href="#"
                                   class="text-base text-gray-500 hover:text-gray-900 block font-semibold ">
                                   Terms and Conditions
                              </a>

                              @endforelse

                         </div>
                    </div>

                    <div class="mt-12 md:mt-0">
                         <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase "> MY ACCOUNT </h3>
                         <div class="mt-4 space-y-4 ">
                              <a title="Login" href="{{Route('login')}}"
                                   class="text-base text-gray-500 hover:text-gray-900 block font-semibold ">
                                   Login
                              </a>
                              <a title="Account" href="#"
                                   class="text-base text-gray-500 hover:text-gray-900 block font-semibold ">
                                   Account
                              </a>
                              <a title="title" href="#"
                                   class="text-base text-gray-500 hover:text-gray-900 block font-semibold ">
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