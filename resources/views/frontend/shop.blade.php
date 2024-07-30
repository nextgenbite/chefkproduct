@extends('layouts.frontend')
@section('title', 'Shop')
@section('content')
<!-- ---- BreadCrum ----- -->
<div class="container py-1 flex justify-between ">
     <div class="flex gap-3 items-center ">
          <a href="{{url('/')}}" class="text-primary-light text-base">
               <i class="fas fa-home"></i>
          </a>
          <span class="text-sm text-gray-500 ">
               <i class="fas fa-chevron-right"></i>
          </span>
          <p class="text-gray-500 font-medium">Shop</p>
     </div>

</div>
<!-- ---- End BreadCrum --->

<!-- ---- Shop Wrapper --->
<div class="container grid md:grid-cols-4 gap-6 pt-2 pb-14 items-start relative">
     <!-- ---- Sidebar --->
     <div id="filter-bar"
          class="hidden  col-span-1 bg-gray-100 px-4 pt-4 pb-6 shadow-sm rounded overflow-y-auto lg:overflow-hidden fixed h-screen lg:h-auto  lg:static left-0 lg:left-4 top-0 lg:top-0 z-40 md:z-10 w-fit lg:w-full lg:block">
          <div class="divide-gray-300 divide-y space-y-5 relative">
               <!-- ---- Category filter --->
               <div class="relative">

                    <button type="button" id="filter-bar-close"
                         class="lg:hidden absolute right-0 top-0 cursor-pointer text-red-700 border border-red-200 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                              height="24" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                         </svg>

                         <span class="sr-only">Icon description</span>
                    </button>
                    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Categories </h3>
                    <div class="space-y-2">
                         @forelse ($categories as $item)
                         <!-- ----Single Category  --->
                         <div class="flex items-center">
                              <input type="checkbox" id="category-filter" value="{{$item->id}}"
                                   class="text-primary-light focus:ring-0 rounded-sm cursor-pointer peer" />
                              <label for="Bedroom"
                                   class="text-gray-600 ml-3 cursor-pointer capitalize peer-checked:text-primary-light peer-checked:font-semibold">{{$item->title}}</label>
                              <div
                                   class="ml-auto text-gray-600 text-sm peer-checked:text-primary-light peer-checked:font-semibold">
                                   ({{$item->products->count()}})</div>

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
                              <input type="checkbox" id="brand-filter" value="{{$item->id}}"
                                   class="text-primary-light focus:ring-0 rounded-sm cursor-pointer peer" />
                              <label for="{{$item->title}}"
                                   class="text-gray-600 ml-3 cursor-pointer capitalize peer-checked:text-primary-light peer-checked:font-semibold">{{$item->title}}</label>
                              <div
                                   class="ml-auto text-gray-600 text-sm peer-checked:text-primary-light peer-checked:font-semibold">
                                   ({{$item->products->count()}})</div>

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
                         <input type="text"
                              class="w-full border-gray-300 focus:ring-0 focus:border-primary-light px-3 py-1 text-gray-600 text-sm shadow-sm rounded "
                              placeholder="Min" />
                         <span class="mx-3 text-gray-500"> - </span>
                         <input type="text"
                              class="w-full border-gray-300 focus:ring-0 focus:border-primary-light px-3 py-1 text-gray-600 text-sm shadow-sm rounded "
                              placeholder="Mix" />
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
                              <label for="size-s"
                                   class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 ">S</label>
                         </div>
                         <!-- ---- End Single Size --->

                         <!-- ---- Single Size --->
                         <div class="size-selector">
                              <input type="radio" name="size" class="hidden" id="size-m" />
                              <label for="size-m"
                                   class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 ">M</label>
                         </div>
                         <!-- ---- End Single Size --->


                         <!-- ---- Single Size --->
                         <div class="size-selector">
                              <input type="radio" name="size" class="hidden" id="size-l" />
                              <label for="size-l"
                                   class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 ">L</label>
                         </div>
                         <!-- ---- End Single Size --->


                         <!-- ---- Single Size --->
                         <div class="size-selector">
                              <input type="radio" name="size" class="hidden" id="size-xs" />
                              <label for="size-xs"
                                   class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 ">XS</label>
                         </div>
                         <!-- ---- End Single Size --->


                         <!-- ---- Single Size --->
                         <div class="size-selector">
                              <input type="radio" name="size" class="hidden" id="size-xl" />
                              <label for="size-xl"
                                   class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 ">XL</label>
                         </div>
                         <!-- ---- End Single Size --->

                    </div>
               </div>
               <!-- ---- End Size filter --->

               <!-- ----  Color filter --->
               <div class="pt-4">
                    <h3 class="text-lg text-gray-800 mb-3 uppercase font-medium ">Color </h3>

                    <div class="flex items-center gap-2">
                         @forelse ($colors as $item)

                         <!-- ---- Single Color --->
                         <div class="color-selector flex flex-col items-center justify-start">
                              <input type="radio" value="{{$item->id}}" name="color" class="hidden"
                                   id="color-{{$item->name}}" checked />
                              <label for="color-{{$item->name}}" style="background-color: {{$item->code}};"
                                   class="text-xs border border-gray-200 rounded h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm"></label>
                              <p class="text-xs  capitalize">{{$item->name}}</p>
                         </div>
                         <!-- ----  End Single Color --->
                         @empty

                         @endforelse


                         <!-- ---- Single Color --->
                         {{-- <div class="color-selector">
                              <input type="radio" name="color" class="hidden" id="color-black" />
                              <label for="color-black" style="background-color: #000000;"
                                   class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm"></label>
                              <p class="text-sm text-gray-700 font-roboto">black</p>
                         </div> --}}
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
               <select id="sort"
                    class=" w-32 lg:w-44 text-sm text-gray-600 px-4 py-2 border-gray-300 shadow-sm rounded focus:ring-primary-light focus:border-primary-light ">
                    <option>Default sorting</option>
                    <option value="price_low_to_high">Price low-high</option>
                    <option value="price_high_to_low">Price high-low</option>
                    <option value="latest">Latest product</option>
               </select>
               <div class="flex gap-2 ml-auto ">
                    <button
                         class=" lg:hidden border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer ">
                         <i id="filter-btn" class="fas fa-filter"></i>
                    </button>
                    <div
                         class="border border-primary-light w-10 h-9 flex items-center justify-center text-white bg-primary-light rounded cursor-pointer ">
                         <i class="fas fa-th"></i>
                    </div>

                    {{-- <div
                         class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer ">
                         <i class="fas fa-list"></i>
                    </div> --}}

               </div>
          </div>

          <!-- ----End Shorting --->
          <div class="relative items-center block ">
               <div id="product-list" class="tracking-tight">
     
                    <!-- ---Product Wrapper --->
                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-6" >
               
                         @forelse ($products as $product)
               
                         @include('frontend.partials.product-x', ['product' => $product])
               
               
                         @empty
                         <div class="text-red-600 text-center text-bold">No Data Found</div>
                         @endforelse
               
               
                    </div>
                    <!-- -- Product pagination --->
                    <div class="flex- justify-center">
                         {{$products->links()}}
                         </div>
               
                    <!-- -- End Product pagination --->
               
                    <!-- --End Product Wrapper --->
               </div>
               
               <div role="status" style="display: none" class="shopLoading   absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                   <svg aria-hidden="true" class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                   <span class="sr-only">Loading...</span>
               </div>
           </div>

     </div>

     <!-- ---- End Product --->

</div>

<!-- ---- End Shop Wrapper --->
@endsection
@push('scripts')
<script>
     $(document).ready(function() {
$('#filter-btn').click(function () {
     $('#filter-bar').toggle();
     // alert('test');
})
$('#filter-bar-close').click(function () {
     $('#filter-bar').toggle();
     // alert('test');
})


             // Function to fetch products based on filters
        function fetchProducts() {
            var categories = [];
            let productList = $('#product-list');
            productList.addClass('opacity-20')
            let loading = $('.shopLoading');
               loading.fadeIn();
            $('#category-filter:checked').each(function() {
                categories.push($(this).val());
            });
            var brands = [];
            $('#brand-filter:checked').each(function() {
                brands.push($(this).val());
            });
            var sort = $('#sort').val();

            $.ajax({
                url: "{{ route('shop') }}",
                method: 'GET',
                data: {
                    category: categories,
                    sort: sort,
                    brand: brands,
                },
                dataType: 'json',
                success: function(response) {
                     productList.empty();
                     loading.fadeOut();
                     productList.removeClass('opacity-20')
                    if (response.html.length !== 0) {

                    productList.html(response.html);
                } else {
                    productList.append('<div class="text-red-600 flex justify-center item-center text-bold">No Data Found</div>');
                }
                }
            });
        }
           // Event listeners for filters
           $(document).on('change', '#category-filter, #sort , #brand-filter ', function() {
    fetchProducts();
});
     //    $('#category-filter').change(fetchProducts);
     //    $('#sort').change(fetchProducts);
     });
</script>
@endpush