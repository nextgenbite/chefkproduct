<style>
    .thumb {
        max-height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .badge-custom {
        display: inline-block;
        padding: 0.1875rem;
        /* 3px converted to rem */
        font-size: 0.6875rem;
        /* 11px converted to rem */
        border-radius: 0 3.125rem 3.125rem 0;
        /* 50px converted to rem */
        color: #ff0000;
        font-weight: 600;
        line-height: 1.625rem;
        /* 26px converted to rem */
        position: absolute;
        background: #fff;
        z-index: 1;
        top: 1rem;
        box-shadow: 0.125rem 0.0625rem 0.375rem 0.125rem rgba(0, 0, 0, 0.1), 0 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.06) !important;
    }

    .badge-custom .box {
        height: 1.625rem;
        /* 26px converted to rem */
        width: 1.625rem;
        /* 26px converted to rem */
        background: #ff0000;
        color: #fff;
        display: inline-block;
        border-radius: 50%;
        text-align: center;
    }
</style>

<!-- ---- Start Single Product  ----- -->
<div
class="group rounded bg-white my-1 shadow-lg border border-gray-200 overflow-hidden transition-all ease-in-out duration-300">
<a  href="{{Route('product.view',$product->slug)}}">

    <div  class="overflow-hidden relative">
        <span v-if="product.discount" class="badge-custom">OFF<span class="box ml-1 mr-0">&nbsp;{{
                discountPercentage($product->price, $product->discount) }}%</span></span>
        <img src="{{asset('/images/loader.svg')}}" width="40"
            data-src="{{ asset($product->thumbnail ?? 'images/no-image.png') }}" alt="{{ $product->title }}"
            class="thumb lazy group-hover:scale-125 ease-in duration-500" />
    </div>
</a>

    <div class="pt-4 pb-3 px-4 ">
            <a href="{{Route('product.view',$product->slug)}}"
                class="capitalize font-medium text-xs lg:text-base  mb-2 text-gray-600 hover:text-primary-light transition line-clamp-2  group-hover:line-clamp-3 ease-in-out duration-500">
                {{ $product->title }} </a>
        <div class="flex justify-between items-baseline mb-1 space-x-1 ">
            <p class="text-sm lg:text-xl text-red-600 font-roboto font-semibold ">
                {{ $product->discount ? formatCurrency($product->discount) : formatCurrency($product->price) }}
                @if ($product->discount)
            <p class="text-sm text-gray-400 font-roboto  line-through "> {{ formatCurrency($product->price) }}
            </p>
            @endif
            </p>
            <button type="button" data-id="{{$product->id}}" class="add-to-cart text-primary-light border border-primary-light hover:bg-primary-light hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                <i class="fas fa-cart-plus"></i>
                </button>
        </div>
        <div class="flex items-center ">
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
              <div class="text-xs text-gray-500 ml-3 ">({{$product->reviews()->count()}})</div>

         </div> 
    </div>


</div>
<!-- ---- End Single Product  ----- -->