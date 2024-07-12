@extends('layouts.frontend', ['meta' => [
    'title' => 'Page Title'.  $product->title,
    'description' => 'Page Description',
    'og:title' => 'Open Graph Title',
    'og:description' => 'Open Graph Description',
    'og:image' => asset($product->thumbnail),
    // Add more meta tags as needed
]])
@section('title', $product->title)
@section('meta')
    {{-- @php
        $availability = "out of stock";
        $qty = 0;
        if($detailedProduct->variant_product) {
            foreach ($detailedProduct->stocks as $key => $stock) {
                $qty += $stock->qty;
            }
        }
        else {
            $qty = optional($detailedProduct->stocks->first())->qty;
        }
        if($qty > 0){
            $availability = "in stock";
        }
    @endphp
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:brand" content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">
    <meta property="product:availability" content="{{ $availability }}">
    <meta property="product:condition" content="new">
    <meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">
    <meta property="product:retailer_item_id" content="{{ $detailedProduct->slug }}">
    <meta property="product:price:currency"
        content="{{ get_system_default_currency()->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}"> --}}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/xzoom/example/css/xzoom.css') }}" media="all" />

    <link type="text/css" rel="stylesheet" media="all"
        href="{{ asset('assets/plugins/xzoom/example/fancybox/source/jquery.fancybox.css') }}" />
@endpush
@section('content')
    <div class="container">

        <!-- default start -->
        <div class="large-5 column">
            {{-- <div class="xzoom-container grid lg:grid-cols-2">
           <img class="xzoom" id="xzoom-fancy" src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/01_b_car.jpg"              xoriginal="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg" />
           <div class="xzoom-thumbs">
             <a href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"><img class="xzoom-gallery" width="80" src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/thumbs/01_b_car.jpg"  xpreview="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/01_b_car.jpg" title="The description goes here"></a>
               
             <a href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg"><img class="xzoom-gallery" width="80" src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/02_o_car.jpg" title="The description goes here"></a>
               
             <a href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg"><img class="xzoom-gallery" width="80" src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/03_r_car.jpg" title="The description goes here"></a>
               
             <a href="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/04_g_car.jpg"><img class="xzoom-gallery" width="80" src="http://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/preview/04_g_car.jpg" title="The description goes here"></a>
           </div>
         </div>         --}}


        </div>
        <!-- default end -->
    </div>
    <!-- ---- BreadCrum ----- -->
    <div class="container py-4 flex justify-between ">
        <div class="flex gap-3 items-center ">
            <a href="{{ url('/') }}" class="text-primary-light text-xs md:text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-xs md:text-sm text-gray-500 ">
                <i class="fas fa-chevron-right"></i>
            </span>
            <a href="{{ route('categories.show',$product->category->slug ) }}" class="text-primary-light font-medium  text-xs md:text-base capitalize">{{ $product->category->title }}</a>

            <span class="text-xs md:text-sm text-gray-500 ">
                <i class="fas fa-chevron-right"></i>
            </span>
            <p class="text-gray-500 text-xs md:text-base font-medium capitalize">{{ $product->title }}</p>
        </div>

    </div>
    <!-- ---- End BreadCrum --->

    <!-- ---- Product View  --->
    <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6 ">
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
    </div>  --}}
        <div class="xzoom-container flex flex-col md:flex-row md:flex-row-reverse justify-center md:justify-start gap-2">
            <!-- Main image -->
            <img class="xzoom4 object-cover rounded-md" id="xzoom-fancy" width="500" height="500"
                src="{{ asset($product->thumbnail) }}" xoriginal="{{ asset($product->thumbnail) }}" />

            <!-- Thumbnails -->
            <div class="xzoom-thumbs w-full md:w-auto flex flex-wrap md:flex-col items-center">
                <!-- First thumbnail (Main image) -->
                <a href="{{ asset($product->thumbnail) }}" class="mx-1 mb-2 md:mb-1 ">
                    <img class="xzoom-gallery4 object-cover rounded-md hover:shadow-md" width="60"
                        src="{{ asset($product->thumbnail) }}" xpreview="{{ asset($product->thumbnail) }}" alt="Thumbnail"
                        title="The description goes here">
                </a>

                <!-- Additional thumbnails -->
                @foreach ($product->images as $image)
                    <a href="{{ asset($image->path) }}" class="mx-1 mb-2 md:mb-1">
                        <img class="xzoom-gallery4 object-cover rounded-md hover:shadow-md" width="60"
                            src="{{ asset($image->path) }}" alt="Thumbnail" title="The description goes here">
                    </a>
                @endforeach
            </div>
        </div>


        <!-- ---- End Product Image  --->

        <!-- ---- Product Content  --->
        <div>
            <h2 class="md:text-xl text-md font-medium uppercase mb-2">{{ $product->title }}</h2>
            {{-- <div class="flex items-center mb-4">
              <div class="flex gap-1 text-sm text-yellow-400 ">
                   <span><i class="fas fa-star"></i> </span>
                   <span><i class="fas fa-star"></i> </span>
                   <span><i class="fas fa-star"></i> </span>
                   <span><i class="fas fa-star"></i> </span>
                   <span><i class="fas fa-star"></i> </span>
              </div>
              <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
         </div> --}}

            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2 ">
                    <span>Availability : </span>
                    @if ($product->stock > 5)
                        <span class="text-green-600">In Stock </span>
                    @elseif ($product->stock <= 5)
                        <span class="text-yellow-600"> Stock Low</span>
                    @else
                        <span class="text-red-600"> Stock Out</span>
                    @endif
                </p>
                    {{-- <span>Brand:</span>
                    <span class="text-gray-600 capitalize col-span-3">{{ $product->brand?->title  }} </span> --}}

                
      
                @if ($product->brand)
                    <p class="text-gray-800 font-semibold space-x-3 ">
                        <span>Brand:</span>
                        <span class="text-gray-600 capitalize">{{ $product->brand->title }} </span>
                    </p>
                @endif
                @if ($product->category)
                    <p class="text-gray-800 font-semibold space-x-3 ">
                        <span>Category:</span>
                        <span class="text-gray-600 capitalize">{{ $product->category->title }} </span>
                    </p>
                @endif
                {{-- <p class="text-gray-800 font-semibold space-x-2 ">
                   <span>SKU : </span>
                   <span class="text-gray-600" >AKHASFD34 </span>
              </p>  --}}
            </div>

            <div class="mt-4 flex items-baseline gap-3 ">
                <span
                    class="text-primary-light font-semibold text-xl ">{{ $product->discount ? formatCurrency($product->discount) : formatCurrency($product->price) }}</span>
                @if ($product->discount)
                    <span class="text-gray-500 text-base line-through">{{ formatCurrency($product->price) }}</span>
                @endif
            </div>


            <!-- ---- Size filter --->
            @if (isset($product->variations))
            <div class="pt-4">
                <h3 class="text-md text-gray-800 mb-3 uppercase font-medium ">Size </h3>
                <div class="flex items-center gap-2">
                    @forelse($product->variations->filter->size as $item)
                    <!-- ---- Single Size --->
                    <div class="size-selector">
                        <input type="radio" name="size" class="hidden peer" value="{{$item->size->id}}" id="{{$item->size->name}}" {{$loop->first ? "checked" : ''}}/>
                        <label for="{{$item->size->name}}"
                            class="text-xs border peer-checked:bg-primary-light  border-gray-200 rounded-lg h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 uppercase">{{$item->size->name}}</label>
                    </div>
                    <!-- ---- End Single Size --->
                    @empty
                     <!-- ---- Single Size --->
                     <div class="size-selector">
                        <input type="radio" name="size" class="hidden peer" disabled />
                        <label for="size"
                            class="text-xs border peer-checked:bg-primary-light  border-gray-200 rounded-lg h-6 p-1 flex items-center justify-center cursor-pointer shadow-sm text-gray-600 uppercase">Regular</label>
                    </div>
                    <!-- ---- End Single Size --->
                    @endforelse  

                </div>
            </div>
            @endif
            <!-- ---- End Size filter --->

            <!-- ----  Color filter --->
            @if (isset($product->variations))
            <div class="pt-4">
                <h3 class="text-md text-gray-800 mb-3 uppercase font-medium ">Color</h3>

                <div class="flex items-center gap-2">
                    @forelse ($product->variations->filter->color as $item)
                          <!-- ---- Single Color --->
                    <div class="color-selector  ">
                        <input  type="radio" name="color" class="hidden" value="{{$item->color->id}}" id="{{$item->color->name}}" {{$loop->first ? "checked" : ''}} />
                        <label for="{{$item->color->name}}" style="background-color:   {{$item->color->code}};"
                            title="{{ucfirst($item->color->name)}}"  class="text-xs border  border-gray-200 shadow rounded-full h-5 w-5 flex items-center justify-center cursor-pointer"></label>

                    </div>
                    <!-- ----  End Single Color --->
                    @empty
                          <!-- ---- Single Color --->
                    <div class="color-selector  ">
                        <input  type="radio" name="color" class="hidden" disabled />
                        <label for="color" 
                            title="Regular"  class="text-xs border  border-gray-200 shadow rounded-full h-5 w-5 flex items-center justify-center cursor-pointer"></label>

                    </div>
                    <!-- ----  End Single Color --->
                    
                    @endforelse
                    
                </div>
            </div>
            @endif
            <!-- ---- End Color filter --->

            <!-- ---- Quantity --->
            <div class="mt-4">                

    <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
    <div class="relative flex items-center max-w-[3rem]">
        <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-2.5 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
            </svg>
        </button>
        <input type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" data-input-counter-min="1" data-input-counter-max="5" class="bg-gray-50 border-x-0 border-gray-300 h-8 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-10 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1" required />
        <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2.5 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
        </button>
    </div>
            </div>
            <!-- ---- End Quantity --->


            <!-- ---- ADD TO CART BUTTON --->
            
            
            <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6 ">
                <a href="javascript:void(0)" id="AddToCart"
                    class="border border-gray-600 text-gray-600 px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary-light transition text-sm flex items-center add-to-cart">
                    <span class="mr-2"><i class="fas fa-cart-plus"></i> </span>
                    Add To Cart
                </a>
                <a href="javascript:void(0)" id="buyNow"
                    class="bg-primary-light border border-primary-light  text-white px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary-light transition text-sm flex items-center add-to-cart">
                    <span class="mr-2"><i class="fas fa-shopping-bag"></i> </span>
                    Buy Now
                </a>

            </div>
            <!-- ---- End ADD TO CART BUTTON --->

            <!-- ---- Product Share Icon --->

            <div class="flex space-x-3 mt-4 ">
                <a href="#"
                    class="text-gray-400 hover:text-gray-600 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-gray-600 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-twitter"></i>
                </a>

                <a href="#"
                    class="text-gray-400 hover:text-gray-600 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-instagram"></i>
                </a>

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
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
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
                <p class=" text-center">There have been no reviews for this product yet.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
                aria-labelledby="settings-tab">

                <div class="mw-100 overflow--hidden">
                    <div class="grid grid-cols-12 no-gutters mt-3 ">
                        <div class="col-span-1">
                            <i class="fa fa-phone" aria-hidden="true"
                                style="font-size: 18px;color: #8a8686;"></i>
                        </div>
                        <div class="col-span-4">
                            <div class="product-description-label">
                                Call:</div>
                        </div>
                        <div class="col-span-7">
                            <a href="tel:01650044628" target="_blank">
                                01650044628
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-3">
                        <div class="col-span-1">
                            <i class="fa fa-plane" aria-hidden="true"
                                style="font-size: 18px;color: #8a8686;"></i>
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
                            <i class="fa fa-truck" aria-hidden="true"
                                style="font-size: 18px;color: #8a8686;"></i>
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
                            <i class="fa fa-money" aria-hidden="true"
                                style="font-size: 18px;color: #8a8686;"></i>
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



            
                    <div class="grid grid-cols-12 mt-3">
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
                    </div>
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

@push('custom-script')
    <script src="{{ asset('assets/plugins/xzoom/xzoom.min.js') }}"></script>
    <!-- Include Hammer.js library -->
    <script src="{{ asset('assets/plugins/xzoom/example/hammer.js/1.0.5/jquery.hammer.min.js') }}"></script>
    <!-- Include Fancybox JavaScript file (if using) -->
    <script src="{{ asset('assets/plugins/xzoom/example/fancybox/source/jquery.fancybox.js') }}"></script>


    <script>
        // Add a product to the cart
        $(document).on('click','.add-to-cart', function () {
            let quantity = 1;
            const inputQty = $('#quantity-input');
            if (inputQty.length) {
                quantity = inputQty.val();
            }
            // Get selected color and size values
            const selectedColor = $('input[name=color]:checked').val()  || null;
            const selectedSize = $('input[name=size]:checked').val()  || null;
       
            $.ajax({
                type: 'post',
                url: "{{ url('/cart/add') }}",
                // _token: '{{ csrf_token() }}',
                data: {
                    product_id: '{{$product->id}}',
                    quantity: quantity,
                    color: selectedColor,
                    size: selectedSize
                },
                success: function(data) {
                    // updateNavCart(data.count);
                    showFrontendAlert('success', 'Successfully added to cart');
                    if ($(this).id = 'buyNow') {
                        
                        window.location.href = '/checkout';
                    }
                   
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                }
            }) 
        })

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

        // (function($) {
           
        // })(jQuery);
    </script>
@endpush
