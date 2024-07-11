@foreach ($result as $item)
    
<li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
    <a href="{{ url('/product/'.$item->slug) }}">{{$item->title}} <br>
        <p class="text-sm lg:text-xl text-red-600 font-roboto font-semibold ">
            {{ $item->discount ? formatCurrency($item->discount) : formatCurrency($item->price) }}
            @if ($item->discount)
                <p class="text-sm text-gray-400 font-roboto  line-through "> {{ formatCurrency($item->price) }}
                </p>
            @endif
        </p>
      </a>
 </li>
@endforeach