@extends('layouts.frontend',['page_title' => 'Profile of '. auth()->user()->name] )

@section('content')
    <!-- ---- BreadCrum ----- -->
 <div class="container py-4 flex justify-between " >
    <div class="flex gap-3 items-center ">
         <a href="index.html" class="text-primary text-base">
             <i class="fas fa-home"></i>
         </a>
         <span class="text-sm text-gray-500 ">
             <i class="fas fa-chevron-right" ></i>
         </span>
         <p class="text-gray-500 font-medium uppercase">My Account</p>
    </div>

</div>
<!-- ---- End BreadCrum --->

<!-- ---- Account Wrapper--->

<div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-16 ">
      <!-- ---- Sidebar --->
      <div class="col-span-3">
           <!-- ---- User Profile --->
           <div class="px-4 py-3 shadow flex bg-gray-100 items-center gap-4 ">
                <div class="flex-shrink-0"> 
                     <img src="{{asset(auth()->user()->avatar ? auth()->user()->avatar : '/images/no-image.png')}}" class="rounded-full w-14 h14 p-1 border border-gray-200 object-cover " /> 
                </div>
                <div>
                     <p class="text-gray-600">Hello..</p>
                     <h4 class="text-gray-800 capitalize font-semibold">{{auth()->user()->name}}</h4>
                </div>

           </div>
           <!-- ----End User Profile --->

<!-- ---- Profile Link --->
<div class="mt-6 bg-gray-100 shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600 ">
      <!-- ---- single Link --->
      <div class="space-y-1 pl-8">
           <a href="#" class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
              Manage Account 
              <span class="absolute -left-8 top-0 text-base ">
                   <i class="far fa-address-card"></i>
              </span>
           </a>
           <a href="#" class="hover:text-primary transition capitalize block" >Profile Information </a>
           <a href="#" class="hover:text-primary transition capitalize block" >Manage Address  </a>
           <a href="#" class="hover:text-primary transition capitalize block" >Change password </a> 
      </div> 
       <!-- ---- End single Link --->


        <!-- ---- single Link --->
      <div class="space-y-1 pl-8 pt-4">
         <a href="#" class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
            My order History
            <span class="absolute -left-8 top-0 text-base ">
                 <i class="fas fa-gift"></i>
            </span>
         </a>
         <a href="#" class="hover:text-primary transition capitalize block" >My returns </a>
         <a href="#" class="hover:text-primary transition capitalize block" >my cancellations  </a>
         <a href="#" class="hover:text-primary transition capitalize block" >my review </a> 
    </div> 
     <!-- ---- End single Link --->


       <!-- ---- single Link --->
       <div class="space-y-1 pl-8 pt-4">
         <a href="#" class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
           Payment Method 
            <span class="absolute -left-8 top-0 text-base ">
                 <i class="far fa-credit-card"></i>
            </span>
         </a>
         <a href="#" class="hover:text-primary transition capitalize block" >Voucher</a>
         
    </div> 
     <!-- ---- End single Link --->


       <!-- ---- single Link --->
       <div class="space-y-1 pl-8 pt-4">
         <a href="#" class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
        My wishlist
            <span class="absolute -left-8 top-0 text-base ">
                 <i class="far fa-heart"></i>
            </span>
         </a> 
         
    </div> 
     <!-- ---- End single Link --->


         <!-- ---- single Link --->
         <div class="space-y-1 pl-8 pt-4">
              <a href="{{route('user.logout')}}" class="relative text-base font-medium capitalize hover:text-primary transition block text-primary">
             Logout 
                 <span class="absolute -left-8 top-0 text-base ">
                      <i class="fas fa-sign-out-alt"></i>
                 </span>
              </a> 
              
         </div> 
          <!-- ---- End single Link ---> 
</div> 

 <!-- ----End Profile Link ---> 
      </div>
       <!-- ----End Sidebar--->

<!-- ----Account Content --->
<div class="col-span-9 grid md:grid-cols-3 gap-4 mt-6 lg:mt-0 ">
     <!-- ----single card --->
    <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
         <div class="flex justify-between items-center mb-4 ">
              <h3 class="font-medium capitalize text-gray-800 text-lg">Personal Profile </h3>
              <a href="#" class="text-primary">Edit</a> 
         </div>
         <div class="space-y-1">
              <h3 class="text-gray-700 font-medium">Kazi Ariyan</h3>
              <p class=""text-gray-800 >ariyan@gmail.com</p>
              <p class=""text-gray-800 >(123)3434-43434</p>
         </div> 
    </div>
      <!-- ----End single card --->


       <!-- ----single card --->
    <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
         <div class="flex justify-between items-center mb-4 ">
              <h3 class="font-medium capitalize text-gray-800 text-lg">Shipping Address </h3>
              <a href="#" class="text-primary">Edit</a> 
         </div>
         <div class="space-y-1">
              <h3 class="text-gray-700 font-medium">Kazi Ariyan</h3>
              <p class=""text-gray-800 >ariyan@gmail.com</p>
              <p class=""text-gray-800 >(123)3434-43434</p>
         </div> 
    </div>
      <!-- ----End single card --->


       <!-- ----single card --->
    <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
         <div class="flex justify-between items-center mb-4 ">
              <h3 class="font-medium capitalize text-gray-800 text-lg">Builling Address </h3>
              <a href="#" class="text-primary">Edit</a> 
         </div>
         <div class="space-y-1">
              <h3 class="text-gray-700 font-medium">Kazi Ariyan</h3>
              <p class=""text-gray-800 >ariyan@gmail.com</p>
              <p class=""text-gray-800 >(123)3434-43434</p>
         </div> 
    </div>
      <!-- ----End single card --->

</div>

 <!-- ----End Account Content---> 


</div> 

 <!-- ---- End Account Wrapper ---> 
@endsection