<div class="w-full bg-white shadow-md py-3   transition duration-300 z-50 divide-y divide-gray-300 divide-dashed  ">
    @if ($cart->items)
        <table class="w-full">

            @foreach ($cart->items as $item)
                <!-- ---- Start single category ----- -->
                <tr title="{{ $item['title'] }}"
                    class="p-2 flex items-center justify-between {{ $loop->last ? '' : 'border-b' }}  border-gray-400 hover:bg-gray-200 transition">
                    <td>

                        <img src="{{ asset($item->product->thumbnail) }}" alt="category thumb"
                            class="w-6 md:w-10 ml-1 md:ml-2 max-w-full max-h-full rounded object-contain" />
                    </td>
                    <td class="px-2 w-40">
                        <p class="text-gray-700 text-xs font-semibold truncate">{{ $item->product->title }}</p>
                        <div class="text-gray-700 text-xs font-semibold">
                            {{ $item['quantity'] }}&nbsp;x&nbsp;{{ formatcurrency($item->product->price) }}
                        </div>
                    </td>
                    <td>

                        <button data-product-id="{{ $item['product_id'] }}"
                            class="remove-from-cart text-red-700 text-sm font-semibold"> <i
                                class="fas fa-trash text-red-700"></i></button>
                    </td>
                </tr>

                <!-- ---- single category End ----- -->
            @endforeach
        </table>
        <div class="grid grid-cols-1  mt-3 pt-4">

            <a href="{{ Route('checkout') }}"
                class="inline-flex items-center mx-auto px-4 py-2 text-sm font-medium text-center text-white bg-primary-light rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg></a>
        </div>
    @else
        <p class="text-center text-red-600">Your cart is empty</p>
    @endif
</div>