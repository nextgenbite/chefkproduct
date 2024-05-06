@extends('layouts.frontend')
@section('content')
<!-- ---- Start Banner ----- -->
@include('frontend.partials.banner')
               <!-- ---- End Banner ----- -->

                 <!-- ---- Start Features  ----- -->

          <div class="container py-6 ">
               <div class="lg:w-10/12 grid md:grid-cols-3 lg:grid-cols-3 grid-cols-1 gap-3 lg:gap-6 mx-auto justify-center ">
                    <!-- ---- Single Features  ----- -->
                    <div
                         class="shadow-lg border border-gray-200 rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

                         <img src="/images/icons/delivery-van.svg" class="lg:w-12 w-10 h-12 object-contain " />
                         <div>
                              <h4 class="font-medium capitalize text-sm lg:text-lg ">Free Shipping </h4>
                              <p class="text-gray-500 text-xs lg:text-sm "> Order Over ৳500 </p>
                         </div>
                    </div>
                    <!-- ----End  Single Features  ----- -->


                    <!-- ---- Single Features  ----- -->
                    <div
                         class="shadow-lg border border-gray-200 rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

                         <img src="/images/icons/money-back.svg" class="lg:w-12 w-10 h-12 object-contain " />
                         <div>
                              <h4 class="font-medium capitalize text-sm lg:text-lg ">Money Returns </h4>
                              <p class="text-gray-500 text-xs lg:text-sm "> 14 Days Money Return </p>
                         </div>
                    </div>
                    <!-- ----End  Single Features  ----- -->



                    <!-- ---- Single Features  ----- -->
                    <div
                         class="shadow-lg rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

                         <img src="/images/icons/service-hours.svg" class="lg:w-12 w-10 h-12 object-contain " />
                         <div>
                              <h4 class="font-medium capitalize text-sm lg:text-lg">24/7 Support </h4>
                              <p class="text-gray-500 text-xs lg:text-sm "> Customer Support </p>
                         </div>
                    </div>
                    <!-- ----End  Single Features  ----- -->
               </div>

          </div>

          <!-- ---- End Features  ----- -->


                 <!-- ---- Start Top Feature  ----- -->
 
                 <div class="mx-2 md:container lg:container" >
                    <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase   ">
                         Feature Product 
                    
                         <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    </h2>
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
                         @forelse ($trendProducts as $product)

                                   @include('frontend.partials.product-x', ['product' => $product])
                         @empty
                              <div class="text-red-600 text-center text-bold">No Data Found</div>
                         @endforelse
                    </div>
               </div>
               <hr class=" my-8 bg-gray-200 border-0 dark:bg-gray-700">
               <!-- ---- End Top Feature  ----- -->
               <!-- ---- Start Top New Arrival  ----- -->
               <div class="mx-2 md:container lg:container" >
                    <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
                         New Arrival 
                         <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    </h2>
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
                         @forelse ($newProducts as $product)

                                   @include('frontend.partials.product-x', ['product' => $product])
                         @empty
                              <div class="text-red-600 text-center text-bold">No Data Found</div>
                         @endforelse
                    </div>
               </div>
               <hr class=" my-8 bg-gray-200 border-0 dark:bg-gray-700">
               <!-- ---- End Top New Arrival  ----- -->
               <!-- ---- Start All Products  ----- -->
               <div class="mx-2 md:container lg:container" >
                    <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
                         All Products 
                         <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    </h2>
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
                         @forelse ($products as $product)

                                   @include('frontend.partials.product-x', ['product' => $product])
                         @empty
                              <div class="text-red-600 text-center text-bold">No Data Found</div>
                         @endforelse
                    </div>
               </div>
               <hr class=" my-8 bg-gray-200 border-0 dark:bg-gray-700">
               <!-- ---- End All Products  ----- -->
@endsection