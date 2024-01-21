@extends('layouts.frontend')
@push('meta')
<title>{{ config('app.name', $settings->app_name.' | Shop') }}</title>
     
@endpush
@section('content')
 <!-- ---- BreadCrum ----- -->
 <div class="container py-4 flex justify-between " >
     <div class="flex gap-3 items-center ">
          <a href="{{url('/')}}" class="text-primary text-base">
              <i class="fas fa-home"></i>
          </a>
          <span class="text-sm text-gray-500 ">
              <i class="fas fa-chevron-right" ></i>
          </span>
          <p class="text-gray-500 font-medium">Shop</p>
     </div>

</div>
 <!-- ---- End BreadCrum --->
 
<!-- ---- Shop Wrapper --->
 <div class="container grid md:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
      <!-- ---- Sidebar --->
      <div class="col-span-1 bg-gray-100 px-4 pt-4 pb-6 shadow-sm rounded overflow-hidden absolute  lg:static left-4 top-16 z-10 w-72 lg:w-full lg:block">
         <div class="divide-gray-300 divide-y space-y-5 relative">
         <!-- ---- Category filter --->
              <div class="relative">
                   <div class="lg:hidden text-gray-400 hover:text-primary text-lg absolute right-0 top-0 cursor-pointer ">
                   </div>
                   <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Categories </h3>
                   <div class="space-y-2">
                    @forelse ($categories as $item)
                               <!-- ----Single Category  --->
                        <div class="flex items-center">
                         <input type="checkbox" id="category" value="{{$item->id}}" class="text-primary focus:ring-0 rounded-sm cursor-pointer peer" />
                         <label for="Bedroom" class="text-gray-600 ml-3 cursor-pointer capitalize peer-checked:text-primary peer-checked:font-semibold" >{{$item->title}}</label>
                         <div class="ml-auto text-gray-600 text-sm peer-checked:text-primary peer-checked:font-semibold">({{$item->products->count()}})</div>

                    </div>
                       <!-- ----End Single Category --->
                    @empty
                         
                    @endforelse

                   </div>      
              </div>
         <!-- ---- End Categoryfilter --->


<!-- ---- Brand filter --->
<div class="pt-4">

    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Brand </h3>
    <div class="space-y-2">

     @forelse ($brands as $item)
     <!-- ----Single Brand  --->
<div class="flex items-center">
<input type="checkbox" id="brand" value="{{$item->id}}" class="text-primary focus:ring-0 rounded-sm cursor-pointer peer" />
<label for="Bedroom" class="text-gray-600 ml-3 cursor-pointer capitalize peer-checked:text-primary peer-checked:font-semibold">{{$item->title}}</label>
<div class="ml-auto text-gray-600 text-sm peer-checked:text-primary peer-checked:font-semibold">({{$item->products->count()}})</div>

</div>
<!-- ----End Single Brand --->
@empty

@endforelse
    
         </div>

</div> 
 <!-- ---- End Brand filter --->

<!-- ---- Price filter --->
<div class="pt-4">
    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Price </h3>

    <div class="mt-4 flex items-center ">
         <input type="text" class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded " placeholder="Min" />
         <span class="mx-3 text-gray-500"> - </span>
         <input type="text" class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded " placeholder="Mix" />
    </div> 
</div> 
<!-- ---- End Price filter --->

<!-- ---- Size filter --->

<div class="pt-4">
    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Size </h3>
    <div class="flex items-center gap-2">
         <!-- ---- Single Size --->
         <div class="size-selector">
              <input type="radio" name="size" class="hidden" id="size-s" />
              <label for="size-s" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 " >S</label>
         </div>
         <!-- ---- End Single Size --->

           <!-- ---- Single Size --->
           <div class="size-selector">
              <input type="radio" name="size" class="hidden" id="size-m" />
              <label for="size-m" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 " >M</label>
         </div>
         <!-- ---- End Single Size --->


           <!-- ---- Single Size --->
           <div class="size-selector">
              <input type="radio" name="size" class="hidden" id="size-l" />
              <label for="size-l" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 " >L</label>
         </div>
         <!-- ---- End Single Size --->


           <!-- ---- Single Size --->
           <div class="size-selector">
              <input type="radio" name="size" class="hidden" id="size-xs" />
              <label for="size-xs" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 " >XS</label>
         </div>
         <!-- ---- End Single Size --->


           <!-- ---- Single Size --->
           <div class="size-selector">
              <input type="radio" name="size" class="hidden" id="size-xl" />
              <label for="size-xl" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 " >XL</label>
         </div>
         <!-- ---- End Single Size --->

    </div>
</div>
<!-- ---- End Size filter --->

<!-- ----  Color filter --->
<div class="pt-4">
    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Color </h3>

<div class="flex items-center gap-2">
    <!-- ---- Single Color --->
    <div class="color-selector">
         <input type="radio" name="color" class="hidden" id="color-red" checked />
         <label for="color-red" style="background-color: brown;" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm" ></label>

    </div>
<!-- ----  End Single Color --->

<!-- ---- Single Color --->
<div class="color-selector">
    <input type="radio" name="color" class="hidden" id="color-white"  />
    <label for="color-white" style="background-color:blueviolet;" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm" ></label>

</div>
<!-- ----  End Single Color --->


<!-- ---- Single Color --->
<div class="color-selector">
    <input type="radio" name="color" class="hidden" id="color-black"  />
    <label for="color-black" style="background-color: #000000;" class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm" ></label>

</div>
<!-- ----  End Single Color --->
</div> 
</div>

<!-- ---- End Color filter ---> 

         </div>

      </div>

      <!-- ---- End Sidebar --->

<!-- ---- Product --->
<div class="col-span-3">
     <!-- ---- Shorting --->
     <div class="mb-4 flex items-center ">
         <select class="w-44 text-sm text-gray-600 px-4 py-3 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary " >
              <option>Default sorting</option>
              <option>Price low-high</option>
              <option>Price high-low</option>
              <option>Latest product</option> 
         </select>
         <div class="flex gap-2 ml-auto ">
              <div class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer ">
                   <i class="fas fa-th"></i>
              </div>

              <div class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer ">
                   <i class="fas fa-list"></i>
              </div>

         </div>
     </div>

     <!-- ----End Shorting --->


<!-- ---Product Wrapper --->
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-6">

     @forelse ($products as $product)

     @include('frontend.partials.product-x', ['product' => $product])

     
@empty
<div class="text-red-600 text-center text-bold">No Data Found</div>
@endforelse


</div>
<!-- -- Product pagination ---> 
{{-- <div class="flex- justify-center"> --}}
     {{$products->links()}}
{{-- </div> --}}

<!-- -- End Product pagination ---> 

<!-- --End Product Wrapper ---> 

</div>

 <!-- ---- End Product ---> 

 </div>

<!-- ---- End Shop Wrapper ---> 
@endsection