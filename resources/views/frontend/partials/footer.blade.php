
 <!-- ---- Start Footer  ----- -->
 <Footer class="bg-white pt-16 pb-12 border-t border-gray-100 " >
    <div class="container">
         <div class="xl:grid xl:grid-cols-5 xl:gap-8 ">
              <div class="space-y-1 xl:col-span-2 ">
                   <img alt="image" src="{{asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}" alt="{{isset($settings['app_name']) ? $settings['app_name'] : config('app.name')}} " class=" w-60" /> 
                   <p class="text-gray-500 text-base font-roboto " >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing.
                </p>
                   <div class="flex space-x-5">
                        <a title="facebook" href="{{isset($settings['facebook']) ? $settings['facebook'] : ''}}" class="text-gray-400 hover:text-gray-500" >
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a title="twitter" href="{{isset($settings['twitter']) ? $settings['twitter'] : ''}}" class="text-gray-400 hover:text-gray-500" >
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a title="instagram" href="{{isset($settings['instagram']) ? $settings['instagram'] : ''}}" class="text-gray-400 hover:text-gray-500" >
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a title="linkedin" href="{{isset($settings['linkedin']) ? $settings['linkedin'] : ''}}" class="text-gray-400 hover:text-gray-500" >
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                   </div>
              </div>

  <!-- ---- Footer link   ----- -->

  <div class="flex justify-between  px-6 xl:col-span-3">
     <div>
          <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase"> CONTACT INFO </h3>
          <div class="mt-4 space-y-4">
               <div  class="block">
                    <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Phone</p>
                    <a href="tel:{{isset($settings['phone']) ? $settings['phone'] : ''}}" class="text-base text-gray-500 block">{{isset($settings['phone']) ? $settings['phone'] : ''}}</p>
               </div>
               <div  class="block">
                    <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Email</p>
                    <p class="text-base text-gray-500 block">{{isset($settings['email']) ? $settings['email'] : ''}}</p>
               </div>
               <div  class="block">
                    <p class="text-xs text-gray-400 hover:text-gray-900 block font-semibold">Address</p>
                    <p class="text-base text-gray-500 block">{{isset($settings['address']) ? $settings['address'] : ''}}</p>
               </div>
              
          </div>
     </div>



     <div class="mt-12 md:mt-0">
          <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase " > USEFUL LINK </h3>
          <div class="mt-4 space-y-4 ">
               <a title="title" href="#" class="text-base text-gray-500 hover:text-gray-900 block font-semibold " >
                    Terms and Conditions 
               </a>
               <a title="title" href="#" class="text-base text-gray-500 hover:text-gray-900 block font-semibold " >
                    Return Policy
               </a>

          </div>
     </div> 

     <div class="mt-12 md:mt-0">
       <h3 class="text-sm font-semibold text-gray-400 tracking-wide uppercase " > MY ACCOUNT </h3>
       <div class="mt-4 space-y-4 ">
            <a title="Login" href="{{Route('login')}}" class="text-base text-gray-500 hover:text-gray-900 block font-semibold " >
                 Login 
            </a>
            <a title="Account" href="#" class="text-base text-gray-500 hover:text-gray-900 block font-semibold " >
                 Account
            </a>
            <a title="title" href="#" class="text-base text-gray-500 hover:text-gray-900 block font-semibold " >
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
        <p class="text-white font-semibold " >© Nextgenbite 2024</p>
   
      <div>
        <img alt="image" src="{{asset('images/methods.png')}}" class="h-5" />
      </div>
   
   </div>

</div>


<!-- ---- End Copyright   ----- -->