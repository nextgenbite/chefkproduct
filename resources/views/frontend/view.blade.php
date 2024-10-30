@extends('layouts.frontend')
@section('title', $product->title)
@push('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $product->title }}">
<meta itemprop="description" content="{{ $product->description }}">
<meta itemprop="image" content="{{ $product->thumbnail ? asset($product->thumbnail) : '' }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $product->title }}">
<meta name="twitter:description" content="{{ $product->description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ $product->thumbnail ? asset($product->thumbnail) : '' }}">
<meta name="twitter:data1" content="{{ $product->discount ?: $product->price }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $product->title }}" />
<meta property="og:type" content="product" />
<meta property="og:url" content="{{ url('/product', $product->slug) }}" />
<meta property="og:image" content="{{ $product->thumbnail ? asset($product->thumbnail) : '' }}" />
<meta property="og:description" content="{{ $product->description }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:price:amount" content="{{ $product->discount ?: $product->price }}" />
<meta property="product:brand" content="{{ $product->brand ? $product->brand->name : config('app.name') }}">
<meta property="product:availability" content="{{ $product->stock > 0 ? 'in stock' : 'out of stock' }}">
<meta property="product:condition" content="new">
<meta property="product:price:amount" content="{{ $product->discount ?: $product->price }}">
<meta property="product:retailer_item_id" content="{{ $product->slug }}">
<meta property="product:price:currency" content="TK" />

<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/xzoom/example/css/xzoom.css') }}" media="all" />

<link type="text/css" rel="stylesheet" media="all"
    href="{{ asset('assets/plugins/xzoom/example/fancybox/source/jquery.fancybox.css') }}" />
    <style>
 
     
        .social-btn-sp #social-links ul li {
            display: inline-block;
            margin: 1rem 0;
        }          
       /* For checked stars */
       input:checked + svg {
      color: #f59e0b; /* yellow-400 */
    }
    </style>
@endpush
@section('content')
<div class="container">
  {{-- 
  <div class="rating flex space-x-2">
    <label>
      <input type="radio" name="rating" value="1" class="hidden" />
      <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
      </svg>
    </label>
    <label>
      <input type="radio" name="rating" value="2" class="hidden" />
      <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
      </svg>
    </label>
    <label>
      <input type="radio" name="rating" value="3" class="hidden" />
      <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
      </svg>
    </label>
    <label>
      <input type="radio" name="rating" value="4" class="hidden" />
      <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
      </svg>
    </label>
    <label>
      <input type="radio" name="rating" value="5" class="hidden" />
      <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
      </svg>
    </label>
  </div>
  <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Choose technology:</h3>
  <ul class="grid w-full gap-6 md:grid-cols-3">
      <li>
          <input type="checkbox" id="react-option" value="" class="hidden peer" required="">
          <label for="react-option" class="cursor-pointer   hover:text-amber-500">                           
            
                <svg class="h-6 w-6 text-gray-300 peer-checked:text-amber-500 hover:text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
          </label>
      </li>
      <li>
          <input type="checkbox" id="flowbite-option" value="" class="hidden peer">
          <label for="flowbite-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
              <div class="block">
                  <svg class="mb-2 text-green-400 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M356.9 64.3H280l-56 88.6-48-88.6H0L224 448 448 64.3h-91.1zm-301.2 32h53.8L224 294.5 338.4 96.3h53.8L224 384.5 55.7 96.3z"/></svg>
                  <div class="w-full text-lg font-semibold">Vue Js</div>
                  <div class="w-full text-sm">Vue.js is an model–view front end JavaScript framework.</div>
              </div>
          </label>
      </li>
      <li>
          <input type="checkbox" id="angular-option" value="" class="hidden peer">
          <label for="angular-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
              <div class="block">
                  <svg class="mb-2 text-red-600 w-7 h-7" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M185.7 268.1h76.2l-38.1-91.6-38.1 91.6zM223.8 32L16 106.4l31.8 275.7 176 97.9 176-97.9 31.8-275.7zM354 373.8h-48.6l-26.2-65.4H168.6l-26.2 65.4H93.7L223.8 81.5z"/></svg>
                  <div class="w-full text-lg font-semibold">Angular</div>
                  <div class="w-full text-sm">A TypeScript-based web application framework.</div>
              </div>
          </label>
      </li>
  </ul>
  --}}
    <!-- default start -->
    <div class="large-5 column">
        {{-- <div class="xzoom-container grid lg:grid-cols-2">
            <img class="xzoom" id="xzoom-fancy"
                src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/01_b_car.jpg"
                xoriginal="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg" />
            <div class="xzoom-thumbs">
                <a
                    href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"><img
                        class="xzoom-gallery" width="80"
                        src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/thumbs/01_b_car.jpg"
                        xpreview="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/01_b_car.jpg"
                        title="The description goes here"></a>

                <a
                    href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg"><img
                        class="xzoom-gallery" width="80"
                        src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/02_o_car.jpg"
                        title="The description goes here"></a>

                <a
                    href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg"><img
                        class="xzoom-gallery" width="80"
                        src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/03_r_car.jpg"
                        title="The description goes here"></a>

                <a
                    href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/04_g_car.jpg"><img
                        class="xzoom-gallery" width="80"
                        src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/04_g_car.jpg"
                        title="The description goes here"></a>
            </div>
        </div> --}}


    </div>
    <!-- default end -->
</div>
<!-- ---- BreadCrum ----- -->
<div class="container py-3 flex justify-between  ">
    <div class="flex gap-3 items-center overflow-hidden">
        <a href="{{ url('/') }}" class="text-primary-light text-xs md:text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-xs md:text-sm text-gray-500 ">
            <i class="fas fa-chevron-right"></i>
        </span>
        <a href="{{ route('categories.show',$product->category->slug ) }}"
            class="text-primary-light font-medium  text-xs md:text-base capitalize whitespace-nowrap">{{
            $product->category->title }}</a>

        <span class="text-xs md:text-sm text-gray-500 ">
            <i class="fas fa-chevron-right"></i>
        </span>
        <p class="text-gray-500 text-xs md:text-base font-medium capitalize truncate max-w-screen">{{ $product->title }}
        </p>
    </div>

</div>
<!-- ---- End BreadCrum --->

<!-- ---- Product View  --->
<div class="container  pb-1 grid lg:grid-cols-2 gap-6 ">
    <!-- ---- Product Image  --->
    {{-- <div class="flex flex-row-reverse gap-4 h-fit">
        <div>
            <img id="main-img" src="{{asset($product->thumbnail)}}" class="w-full rounded-md" />
        </div>

        <div class=" ">
            <div>
                <img src="{{asset($product->thumbnail)}}" class="single-img w-28 mb-2 rounded-md cursor-pointer  " />
            </div>
            @foreach ($product->images as $image)

            <div>
                <img src="{{asset($image->path)}}" class="single-img w-28 my-2 rounded-md cursor-pointer   " />
            </div>
            @endforeach



        </div>
    </div> --}}
    <div class="xzoom-container flex flex-col  lg:flex-row-reverse justify-center lg:justify-start gap-2">
        <!-- Main image -->
        <img class="xzoom4 object-cover rounded-md mx-auto lg:w-5/6" id="xzoom-fancy" width="500" height="500"
            src="{{ asset($product->thumbnail) }}" xoriginal="{{ asset($product->thumbnail) }}" />

        <!-- Thumbnails -->
        <div class="xzoom-thumbs w-full lg:w-auto mx-auto flex mb-0 pb-0 flex-wrap lg:flex-col items-center">
            <!-- First thumbnail (Main image) -->
            <a href="{{ asset($product->thumbnail) }}" class="mx-1 lg:mb-1">
                <img class="xzoom-gallery4 object-cover rounded-md hover:shadow-md" width="60"
                    src="{{ asset($product->thumbnail) }}" xpreview="{{ asset($product->thumbnail) }}" alt="Thumbnail"
                    title="The description goes here">
            </a>

            <!-- Additional thumbnails -->
            @foreach ($product->images as $image)
            <a href="{{ asset($image->path) }}" class="mx-1 lg:mb-1">
                <img class="xzoom-gallery4 object-cover rounded-md hover:shadow-md" width="60"
                    src="{{ asset($image->path) }}" alt="Thumbnail" title="The description goes here">
            </a>
            @endforeach
        </div>
    </div>


    <!-- ---- End Product Image  --->

    <!-- ---- Product Content  --->
    <div>
        <h2 class="text-lg md:text-md  font-medium capitalize mb-2 -mt-4 lg:mt-0 -pt-5 lg:pt-0">{{ $product->title }}
        </h2>
    
        <div class="flex items-center mb-3">
            <div class="flex gap-1 text-sm text-amber-500 ">
              @for ($i = 1; $i <= 5; $i++)
              <span>
                  @if ($i <= round($product->averageReview()))
                      <i class="fas fa-star"></i> <!-- Filled star -->
                  @else
                      <i class="far fa-star"></i> <!-- Empty star -->
                  @endif
              </span>
          @endfor
            </div>
            <div class="text-xs text-gray-500 ml-3 ">({{$product->reviews()->count()}} reviews)</div>

       </div> 

        <div class="space-y-2">
            <div class="grid grid-cols-4 text-left text-gray-800 font-semibold capitalize gap-y-4">
                <div class="text-gray-800 font-semibold">Availability</div>
                @if ($product->stock > 5)
                <p class="text-green-600  col-span-3">In Stock </p>
                @elseif ($product->stock <= 5) <span class="text-yellow-600"> Stock Low</span>
                    @else
                    <div class="text-red-600  col-span-3"> Stock Out</div>
                    @endif

                    @if ($product->brand)
                    <p class="text-md text-gray-800 capitalize font-medium font-serif">Brand</p>
                    <div class="text-gray-600 capitalize col-span-3">{{ $product->brand->title }} </div>
                    @endif
                    @if ($product->category)
                    <p class="text-md text-gray-800  capitalize font-medium">Category</p>
                    <div class="text-gray-600 capitalize col-span-3">{{ $product->category->title }} </div>
                    @endif
                    @if ($product->sku)
                        
                    <p class="text-md text-gray-800  capitalize font-medium">SKU</p>
                    <div class="text-gray-600 capitalize col-span-3">{{ $product->sku }} </div>
                    @endif

                    <p class="text-md text-gray-800  capitalize font-medium">Price</p>
                    <div class=" inline-flex items-baseline gap-3 col-span-3">
                        <span class="text-primary-light font-semibold text-xl ">{{ $product->discount ?
                            formatCurrency($product->discount) : formatCurrency($product->price) }}</span>
                        @if ($product->discount)
                        <span class="text-gray-500 text-base line-through">{{ formatCurrency($product->price) }}</span>
                        @endif
                    </div>
                    <!-- ---- Size filter --->
                    @if ($product->variations && $product->variations->whereNotNull('size')->isNotEmpty())

                    <p class="text-md text-gray-800">Sizes</p>
                    <div class="inline-flex items-center gap-2 col-span-3">
                        @forelse($product->variations->whereNotNull('size') as $item)
                        <!-- ---- Single Size --->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden peer" value="{{$item->size->id}}"
                                id="{{$item->size->name}}" {{$loop->first ? "checked" : ''}}/>
                            <label for="{{$item->size->name}}"
                                class="text-xs border peer-checked:bg-primary-light border-gray-200 rounded-lg h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 uppercase">{{$item->size->name}}</label>
                        </div>
                        <!-- ---- End Single Size --->
                        @empty
                        <!-- ---- No Sizes Available --->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden peer" disabled />
                            <label for="size"
                                class="text-xs border peer-checked:bg-primary-light border-gray-200 rounded-lg h-6 p-1 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 uppercase">Regular</label>
                        </div>
                        <!-- ---- End No Sizes Available --->
                        @endforelse
                    </div>
                    @endif
                    <!-- ---- End Size filter --->

                    <!-- ----  Color filter --->
                    @if ($product->variations && $product->variations->whereNotNull('color')->isNotEmpty())
                    <p class="text-md text-gray-800">Colors</p>
                    <div class="inline-flex items-center gap-2 col-span-3">
                        @forelse ($product->variations->whereNotNull('color') as $item)
                        <!-- ---- Single Color --->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" value="{{$item->color->id}}"
                                id="{{$item->color->name}}" {{$loop->first ? "checked" : ''}} />
                            <label for="{{$item->color->name}}" style="background-color: {{$item->color->code}};"
                                title="{{ucfirst($item->color->name)}}"
                                class="text-xs border border-gray-200 shadow rounded-full h-5 w-5 flex items-center justify-center cursor-pointer"></label>
                        </div>
                        <!-- ----  End Single Color --->
                        @empty
                        <!-- ---- No Colors Available --->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" disabled />
                            <label for="color" title="Regular"
                                class="text-xs border border-gray-200 shadow rounded-full h-5 w-5 flex items-center justify-center cursor-pointer"></label>
                        </div>
                        <!-- ----  End No Colors Available --->
                        @endforelse
                    </div>
                    @endif
                    <!-- ---- End Color filter --->
                    <!-- ---- Quantity --->
                    <p for="quantity-input" class="text-md text-gray-800">Quantity</p>
                    <div class="relative inline-flex  items-center w-full ">
                        <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-2.5 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" id="quantity-input" data-input-counter
                            aria-describedby="helper-text-explanation" data-input-counter-min="1"
                            data-input-counter-max="5"
                            class="bg-gray-50 border-x-0 w-16 border-gray-300 h-8 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block  py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="1" required />
                        <button type="button" id="increment-button" data-input-counter-increment="quantity-input"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2.5 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <!-- ---- End Quantity --->
            </div>

        </div>

        <!-- ---- ADD TO CART BUTTON --->
        <div class="flex gap-1 lg:gap-3 justify-center lg:justify-start border-b border-gray-200 pb-5 mt-6 ">
            <a href="javascript:void(0)" id="AddToCart" data-id="{{$product->id}}"
                class="border border-gray-600 text-gray-600 px-6 w-full lg:w-auto lg:px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary-light transition text-sm inline-flex justify-center items-center add-to-cart">
                <span class="mr-2"><i class="fas fa-cart-plus"></i> </span>
                Add To Cart
            </a>
            <a href="javascript:void(0)" id="buyNow" data-id="{{$product->id}}"
                class="bg-primary-light border border-primary-light  text-white px-6 w-full lg:w-auto lg:px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary-light transition text-sm inline-flex justify-center items-center add-to-cart">
                <span class="mr-2"><i class="fas fa-shopping-bag"></i> </span>
                Buy Now
            </a>

        </div>
        <!-- ---- End ADD TO CART BUTTON --->

        <!-- ---- Product Share Icon --->
        <div class="social-btn-sp">
            {!! $shareButtons !!}
        </div>


        <!-- ---- End Product Share Icon --->

    </div>

    <!-- ---- End Product Content  --->

</div>

<!-- ---- End Product View --->


<!-- ---- Product Details  --->

<div class="container pb-16">


    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-primary-light hover:text-primary-light dark:text-purple-500 dark:hover:text-purple-500 border-primary-light dark:border-purple-500"
            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="description-styled-tab"
                    data-tabs-target="#styled-description" type="button" role="tab" aria-controls="description"
                    aria-selected="false">DESCRIPTION</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-styled-tab" data-tabs-target="#styled-review" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">REVIEWS</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab"
                    aria-controls="settings" aria-selected="false">SHIPPING INFO</button>
            </li>
        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-description" role="tabpanel"
            aria-labelledby="description-tab">
            <div class="lg:w-4/5 xl:w-3/5 pt-6">
                <div class="space-y-3 text-gray-600">
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>



            </div>

        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-review" role="tabpanel"
            aria-labelledby="dashboard-tab">
            @if ($product->reviews->isNotEmpty())
            <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                  <div class="flex items-center gap-2">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Reviews</h2>
              
                    <div class="mt-2 flex items-center gap-2 sm:mt-0">
                        <div class="flex gap-1 text-sm text-amber-500 ">
                            @for ($i = 1; $i <= 5; $i++)
                            <span>
                                @if ($i <= round($product->averageReview()))
                                    <i class="fas fa-star"></i> <!-- Filled star -->
                                @else
                                    <i class="far fa-star"></i> <!-- Empty star -->
                                @endif
                            </span>
                        @endfor
                          </div>
                      <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">({{round($product->averageReview())}})</p>
                      <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"> {{$product->reviews()->count()}} Reviews </a>
                    </div>


                    
                  </div>
              
                  <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                    <div class="shrink-0 space-y-4">
                      <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">4.65 out of 5</p>
                      <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal" class="mb-2 me-2 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Write a review</button>
                    </div>
              
                    <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">5</p>
                        <svg class="h-4 w-4 shrink-0 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300" style="width: 20%"></div>
                        </div>
                        <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">239 <span class="hidden sm:inline">reviews</span></a>
                      </div>
              
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">4</p>
                        <svg class="h-4 w-4 shrink-0 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300" style="width: 60%"></div>
                        </div>
                        <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">432 <span class="hidden sm:inline">reviews</span></a>
                      </div>
              
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">3</p>
                        <svg class="h-4 w-4 shrink-0 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300" style="width: 15%"></div>
                        </div>
                        <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">53 <span class="hidden sm:inline">reviews</span></a>
                      </div>
              
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">2</p>
                        <svg class="h-4 w-4 shrink-0 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300" style="width: 5%"></div>
                        </div>
                        <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">32 <span class="hidden sm:inline">reviews</span></a>
                      </div>
              
                      <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">1</p>
                        <svg class="h-4 w-4 shrink-0 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                          <div class="h-1.5 rounded-full bg-yellow-300" style="width: 0%"></div>
                        </div>
                        <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">13 <span class="hidden sm:inline">reviews</span></a>
                      </div>
                    </div>
                  </div>
              
                  <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                   
              @foreach ($product->reviews as $review)
                  
              <div class="gap-3 py-6 sm:flex sm:items-start">
                <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                    <div class="flex items-center gap-0.5 text-sm text-amber-500 ">
                        @for ($i = 1; $i <= 5; $i++)
                        <span>
                            @if ($i <= $review->star_rating)
                                <i class="fas fa-star"></i> <!-- Filled star -->
                            @else
                                <i class="far fa-star"></i> <!-- Empty star -->
                            @endif
                        </span>
                    @endfor
                  </div>
        
                  <div class="space-y-0.5">
                    <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{$review->user->name}}</p>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$review->created_at->diffForHumans()}}</p>
                  </div>
        
                  <div class="inline-flex items-center gap-1">
                    <svg class="h-5 w-5 text-primary-700 dark:text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path
                        fill-rule="evenodd"
                        d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Verified purchase</p>
                  </div>
                </div>
        
                <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                  <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$review->comments}}</p>
        
                  <div class="flex gap-2">
                    <img class="h-32 w-20 rounded-lg object-cover" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-photo-1.jpg" alt="" />
                    <img class="h-32 w-20 rounded-lg object-cover" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-photo-2.jpg" alt="" />
                  </div>
        
                  <div class="flex items-center gap-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Was it helpful to you?</p>
                    <div class="flex items-center">
                      <input id="reviews-radio-3" type="radio" value="" name="reviews-radio-2" class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                      <label for="reviews-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Yes: 1 </label>
                    </div>
                    <div class="flex items-center">
                      <input id="reviews-radio-4" type="radio" value="" name="reviews-radio-2" class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                      <label for="reviews-radio-4" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">No: 0 </label>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
                    {{-- <div class="gap-3 py-6 sm:flex sm:items-start">
                      <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                        <div class="flex items-center gap-0.5">
                          <svg class="h-4 w-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
              
                          <svg class="h-4 w-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
              
                          <svg class="h-4 w-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
              
                          <svg class="h-4 w-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
              
                          <svg class="h-4 w-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                          </svg>
                        </div>
              
                        <div class="space-y-0.5">
                          <p class="text-base font-semibold text-gray-900 dark:text-white">Jese Leos</p>
                          <p class="text-sm font-normal text-gray-500 dark:text-gray-400">November 18 2023 at 15:35</p>
                        </div>
              
                        <div class="inline-flex items-center gap-1">
                          <svg class="h-5 w-5 text-primary-700 dark:text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              fill-rule="evenodd"
                              d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                              clip-rule="evenodd"
                            />
                          </svg>
                          <p class="text-sm font-medium text-gray-900 dark:text-white">Verified purchase</p>
                        </div>
                      </div>
              
                      <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">It’s fancy, amazing keyboard, matching accessories. Super fast, batteries last more than usual, everything runs perfect in this computer. Highly recommend!</p>
              
                        <div class="flex gap-2">
                          <img class="h-32 w-20 rounded-lg object-cover" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-photo-1.jpg" alt="" />
                          <img class="h-32 w-20 rounded-lg object-cover" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-photo-2.jpg" alt="" />
                        </div>
              
                        <div class="flex items-center gap-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Was it helpful to you?</p>
                          <div class="flex items-center">
                            <input id="reviews-radio-3" type="radio" value="" name="reviews-radio-2" class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="reviews-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Yes: 1 </label>
                          </div>
                          <div class="flex items-center">
                            <input id="reviews-radio-4" type="radio" value="" name="reviews-radio-2" class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="reviews-radio-4" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">No: 0 </label>
                          </div>
                        </div>
                      </div>
                    </div> --}}
              
                
                  </div>
              
                  <div class="mt-6 text-center">
                    <button type="button" class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">View more reviews</button>
                  </div>
                </div>
              </section>
              
              <!-- Add review modal -->
              <div id="review-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
                <div class="relative max-h-full w-full max-w-2xl p-4">
                  <!-- Modal content -->
                  <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                      <div>
                        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Add a review for:</h3>
                        <a href="#" class="font-medium text-primary-700 hover:underline dark:text-primary-500">{{$product->title}}</a>
                      </div>
                      <button type="button" class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="review-modal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                      <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                          <div class="flex items-center">
                            <svg class="h-6 w-6 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="ms-2 h-6 w-6 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="ms-2 h-6 w-6 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <span class="ms-2 text-lg font-bold text-gray-900 dark:text-white">3.0 out of 5</span>
                          </div>
                        </div>
                        <div class="col-span-2">
                          <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Review title</label>
                          <input type="text" name="title" id="title" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required="" />
                        </div>
                        <div class="col-span-2">
                          <label for="description" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Review description</label>
                          <textarea id="description" rows="6" class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" required=""></textarea>
                          <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Problems with the product or delivery? <a href="#" class="text-primary-600 hover:underline dark:text-primary-500">Send a report</a>.</p>
                        </div>
                        <div class="col-span-2">
                          <p class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Add real photos of the product to help other customers <span class="text-gray-500 dark:text-gray-400">(Optional)</span></p>
                          <div class="flex w-full items-center justify-center">
                            <label for="dropzone-file" class="dark:hover:bg-bray-800 flex h-52 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                              <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                              </div>
                              <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                          </div>
                        </div>
                        <div class="col-span-2">
                          <div class="flex items-center">
                            <input id="review-checkbox" type="checkbox" value="" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="review-checkbox" class="ms-2 text-sm font-medium text-gray-500 dark:text-gray-400">By publishing this review you agree with the <a href="#" class="text-primary-600 hover:underline dark:text-primary-500">terms and conditions</a>.</label>
                          </div>
                        </div>
                      </div>
                      <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button type="submit" class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add review</button>
                        <button type="button" data-modal-toggle="review-modal" class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @else
                
            <p class=" text-center">There have been no reviews for this product yet.</p>
            @endif
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
            aria-labelledby="settings-tab">

            <div class="mw-100 overflow--hidden">
                <div class="grid grid-cols-12 no-gutters mt-3 ">
                    <div class="col-span-1">
                        <i class="fa fa-phone" aria-hidden="true" style="font-size: 18px;color: #8a8686;"></i>
                    </div>
                    <div class="col-span-4">
                        <div class="product-description-label">
                            Call:</div>
                    </div>
                    <div class="col-span-7">
                        <a href="tel:{{isset($settings['phone']) ? $settings['phone'] : ''}}" target="_blank">
                            {{isset($settings['phone']) ? $settings['phone'] : ''}}
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-12 mt-3">
                    <div class="col-span-1">
                        <i class="fa fa-plane" aria-hidden="true" style="font-size: 18px;color: #8a8686;"></i>
                    </div>
                    <div class="col-span-4">
                        <div class="product-description-label">

                            Outside Dhaka:</div>
                    </div>
                    <div class="col-span-7">
                        4-5 working days
                    </div>
                </div>
                <div class="grid grid-cols-12 mt-3">
                    <div class="col-span-1">
                        <i class="fa fa-truck" aria-hidden="true" style="font-size: 18px;color: #8a8686;"></i>
                    </div>
                    <div class="col-span-4">
                        <div class="product-description-label">

                            Inside Dhaka:</div>
                    </div>
                    <div class="col-span-7">
                        2-3 working days

                    </div>
                </div>
                <div class="grid grid-cols-12 mt-3">
                    <div class="col-span-1">
                        <i class="fa fa-money" aria-hidden="true" style="font-size: 18px;color: #8a8686;"></i>
                        <span> </span>
                    </div>

                    <div class="col-span-4">
                        <div class="product-description-label">

                            Cash on Delivery :</div>
                    </div>
                    <div class="col-span-4">
                        Available
                    </div>

                </div>




                {{-- <div class="grid grid-cols-12 mt-3">
                    <div class="col-span-2">
                        <div class="product-description-label alpha-6">Payment:</div>
                    </div>
                    <div class="col-span-10">
                        <ul class="flex gap-2">
                            <li>
                                <img src="https://nobabieshop.com/public/frontend/images/icons/cards/visa.png"
                                    data-src="https://nobabieshop.com/public/frontend/images/icons/cards/visa.png"
                                    width="30" class=" lazyload">
                            </li>
                            <li>
                                <img src="https://nobabieshop.com/public/frontend/images/icons/cards/mastercard.png"
                                    data-src="https://nobabieshop.com/public/frontend/images/icons/cards/mastercard.png"
                                    width="30" class=" ls-is-cached lazyloaded">
                            </li>
                            <li>
                                <img src="https://nobabieshop.com/public/frontend/images/icons/cards/maestro.png"
                                    data-src="https://nobabieshop.com/public/frontend/images/icons/cards/maestro.png"
                                    width="30" class=" ls-is-cached lazyloaded">
                            </li>
                            <li>
                                <img src="https://nobabieshop.com/public/frontend/images/icons/cards/paypal.png"
                                    data-src="https://nobabieshop.com/public/frontend/images/icons/cards/paypal.png"
                                    width="30" class=" ls-is-cached lazyloaded">
                            </li>
                            <li>
                                <img src="https://nobabieshop.com/public/frontend/images/icons/cards/cod.png"
                                    data-src="https://nobabieshop.com/public/frontend/images/icons/cards/cod.png"
                                    width="30" class=" ls-is-cached lazyloaded">
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>



</div>

<!-- ---- End Product Details --->


<!-- ---- Related Product  --->
<div class="mx-2 md:container lg:container">
    <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
        Top Related Products
        <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
    </h2>

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
        @forelse ($relatedProduct as $product)
        @include('frontend.partials.product-x', ['product' => $product])
        @empty
        <div class="text-red-600 text-center text-bold">No Data Found</div>
        @endforelse
    </div>
</div>


<!-- ---- End  Related Product --->
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/xzoom/xzoom.min.js') }}"></script>
<!-- Include Hammer.js library -->
<script src="{{ asset('assets/plugins/xzoom/example/hammer.js/1.0.5/jquery.hammer.min.js') }}"></script>
<!-- Include Fancybox JavaScript file (if using) -->
<script src="{{ asset('assets/plugins/xzoom/example/fancybox/source/jquery.fancybox.js') }}"></script>


<script>
    // Add a product to the cart


        $(document).ready(function() {

$('.xzoom4, .xzoom-gallery4').xzoom({
    tint: '#006699',
    Xoffset: 10,
    lens: true, 
    lensShape: 'circle',
    smoothZoomMove: 1
});

// Integration with hammer.js
var isTouchSupported = 'ontouchstart' in window;

if (isTouchSupported) {
    // If touch device
    $('.xzoom4').each(function() {
        var xzoom = $(this).data('xzoom');
        $(this).hammer().on("tap", function(event) {
            event.pageX = event.gesture.center.pageX;
            event.pageY = event.gesture.center.pageY;

            var counter = 0;
            xzoom.eventclick = function(element) {
                element.hammer().on('tap', function() {
                    counter++;
                    if (counter == 1) setTimeout(openfancy, 300);
                    event.gesture.preventDefault();
                });
            }

            function openfancy() {
                if (counter == 2) {
                    xzoom.closezoom();
                    $.fancybox.open(xzoom.gallery().cgallery);
                } else {
                    xzoom.closezoom();
                }
                counter = 0;
            }
            xzoom.openzoom(event);
        });
    });
} else {
    // If not touch device
    $('#xzoom-fancy').bind('click', function(event) {
        var xzoom = $(this).data('xzoom');
        xzoom.closezoom();
        $.fancybox.open(xzoom.gallery().cgallery, {
            padding: 0,
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
        event.preventDefault();
    });
}
});

fbq('track', 'ViewContent', {
            content_ids: ['{{ $product->id }}'],
            content_type: 'product',
            value: {{ round($product->discount ?: $product->price) }},
            currency: 'USD'
        });

        // (function($) {
           
        // })(jQuery);
</script>
@endpush