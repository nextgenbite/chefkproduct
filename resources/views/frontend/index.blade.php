@extends('layouts.frontend')
@push('meta')
<meta itemprop="name" content="{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name')  }}">
<meta itemprop="description" content="{{ isset($settings['about']) ? $settings['about'] : 'Laravel Ecommerce with POS' }}">
<meta itemprop="image" content="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}">

<!-- Primary Meta Tags -->
<meta name="title" content="{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name')  }}" />
<meta name="description" content="{{ isset($settings['about']) ? $settings['about'] : 'Laravel Ecommerce with POS' }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ config('app.url').'/public' }}" />
<meta property="og:title" content="{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name')  }}" />
<meta property="og:description" content="{{ isset($settings['about']) ? $settings['about'] : 'Laravel Ecommerce with POS' }}" />
<meta property="og:image" content="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}" />
<meta property="og:site_name" content="{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name')  }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ config('app.url').'/public' }}" />
<meta property="twitter:title" content="{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name')  }}" />
<meta property="twitter:description" content="{{ isset($settings['about']) ? $settings['about'] : 'Laravel Ecommerce with POS' }}" />
<meta property="twitter:image" content="{{ asset(isset($settings['logo']) ? $settings['logo'] : '/favicon.ico') }}" />

@endpush
@section('content')
<!-- ---- Start Banner ----- -->
@include('frontend.partials.banner')
<!-- ---- End Banner ----- -->

<!-- ---- Start Features  ----- -->

<div class="container py-6 ">
     <div class="lg:w-11/12 grid md:grid-cols-3 lg:grid-cols-4 grid-cols-1 gap-3 mx-auto justify-center ">
          <!-- ---- Single Features  ----- -->
          <div
               class="shadow-lg border border-gray-200 rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

               <img src="/images/icons/delivery-van.svg" alt="Free Shipping" class="lg:w-12 w-10 h-12 object-contain " />
               <div>
                    <h4 class="font-medium capitalize text-sm lg:text-lg ">Free Shipping </h4>
                    <p class="text-gray-500 text-xs lg:text-sm "> Order Over {{formatCurrency(500)}} </p>
               </div>
          </div>
          <!-- ----End  Single Features  ----- -->
          
          <!-- ---- Single Features  ----- -->
          <div
               class="shadow-lg border border-gray-200 rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

               <img src="/images/icons/certified.svg" alt="Money Returns" class="lg:w-12 w-10 h-12 object-contain " />
               <div>
                    <h4 class="font-medium capitalize text-sm lg:text-lg ">BBB & FDA Registered® </h4>
                    <p class="text-gray-500 text-xs lg:text-sm capitalize">we are certified from BBB & FDA </p>
               </div>
          </div>
          <!-- ----End  Single Features  ----- -->
          <!-- ---- Single Features  ----- -->
          <div
               class="shadow-lg border border-gray-200 rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

               <img src="/images/icons/halal.svg" alt="Free Shipping" class="lg:w-12 w-10 h-12 object-contain " />
               <div>
                    <h4 class="font-medium capitalize text-sm lg:text-lg">halal & no alcohol</h4>
                    <p class="text-gray-500 text-xs lg:text-sm capitalize">no preservatives or alcohol used </p>
               </div>
          </div>
          <!-- ----End  Single Features  ----- -->





          <!-- ---- Single Features  ----- -->
          <div
               class="shadow-lg rounded px-3 lg:px-3 lg:py-6 py-2 flex justify-center items-center gap-3 transition hover:border-slate-400 hover:bg-gray-200 duration-300 ">

               <img src="/images/icons/service-hours.svg" alt="24/7 Support" class="lg:w-12 w-10 h-12 object-contain " />
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

<div class="mx-2 md:container lg:container">
     <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase   ">
          Feature Product

          <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
     </h2>
     <div class="grid grid-cols-2 lg:grid-cols-5 gap-1 lg:gap-3">
          @forelse ($trendProducts as $product)

          @include('frontend.partials.product-x', ['product' => $product])
          @empty
          <div class="text-red-600 text-center text-bold">No Data Found</div>
          @endforelse
     </div>
</div>
<!-- ---- End Top Feature  ----- -->
<!-- ---- Start Top New Arrival  ----- -->
<div class="mx-2 md:container lg:container">
     <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
          New Arrival
          <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
     </h2>
     <div class="grid grid-cols-2 lg:grid-cols-5  gap-1 lg:gap-3">
          @forelse ($newProducts as $product)

          @include('frontend.partials.product-x', ['product' => $product])
          @empty
          <div class="text-red-600 text-center text-bold">No Data Found</div>
          @endforelse
     </div>
</div>
<!-- ---- End Top New Arrival  ----- -->
<!-- ---- Start All Products  ----- -->
<div class="mx-2 md:container lg:container">
     <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
          All Products
          <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
     </h2>
     <div class="grid grid-cols-2 lg:grid-cols-5  gap-1 lg:gap-3">
          @forelse ($products as $product)

          @include('frontend.partials.product-x', ['product' => $product])
          @empty
          <div class="text-red-600 text-center text-bold">No Data Found</div>
          @endforelse
     </div>
</div>
<!-- ---- End All Products  ----- -->
<div class="flex justify-center my-2">

     <a href="{{url('/shop')}}" title="See More" class="text-white bg-primary-light hover:bg-primary-light/80 focus:ring-4 focus:outline-none focus:ring-primary-light/30 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
     See More
     <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
     </svg>
     </a>
</div>
           <!-- ---- Start Sartup Modal  ----- -->


           {{-- @include('frontend.partials.startup_modal') --}}
           <!-- ---- End Sartup Modal   ----- -->  
@endsection
@push('scripts')
     <script>
          // set the modal menu element
// const $targetEl = document.getElementById('static-modal');
// new Modal($targetEl).show()
     </script>
@endpush