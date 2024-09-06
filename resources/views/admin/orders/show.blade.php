@extends('layouts.app')
@push('title')
{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name') .' | Dashboard'}}
@endpush
@section('content')
<div
  class="mb-10 rounded-sm border text-gray-700 border-gray-200 bg-white shadow-md dark:border-gray-700  dark:bg-slate-800">
  {{-- <div class="border-b border-gray-200 px-4 py-4 dark:border-gray-700  sm:px-6 xl:px-9">
    <h3 class="font-medium  dark:text-white">Style 1</h3>
  </div> --}}
  {{-- <h3 class="font-medium  dark:text-white">Style 1</h3> --}}

  <div class="p-4 sm:p-6 xl:p-9">
    <div class="flex flex-col-reverse gap-5 xl:flex-row xl:justify-between">
      <div class="flex flex-col gap-4 sm:flex-row xl:gap-9">
        <div>
          <p class="mb-1.5 font-medium text-black dark:text-white">
            From
          </p>
          <h4 class="mb-4 text-title-sm2 font-medium leading-[30px] text-black dark:text-white">
            {{ isset($settings['app_name']) ? $settings['app_name'] : 'Nextgenbite' }}
          </h4>
          <a href="#" class="block"><span class="font-medium">Email:</span>
            {{ isset($settings['email']) ? $settings['email'] : '' }}</a>
          <span class="mt-2 block"><span class="font-medium">Address:</span>
            {{ isset($settings['address']) ? $settings['address'] : '' }}</span>
        </div>
        <div>
          <p class="mb-1.5 font-medium text-black dark:text-white">
            To
          </p>
          <h4 class="mb-4 text-title-sm2 font-medium leading-[30px] text-black dark:text-white">
            {{ $order->name }}
          </h4>
          <a href="#" class="block"><span class="font-medium">Email:</span>
            {{ $order->phone }}</a>
          <span class="mt-2 block"><span class="font-medium">Address:</span> {{ $order->address }}
          </span>
        </div>
      </div>
      <h3 class="text-xl font-medium text-black dark:text-white">
        Invoice No: #{{ $order->code }} <br>
       <div class="text-base"> Payment status: <span class=" capitalize {{$order->payment_status == 'pending' ? 'text-red-400' : 'text-green-400'}}  ">{{$order->payment_status}}</span> </div>
      </h3>
    </div>

    <div class="my-10 rounded-sm border border-gray-200 p-5 dark:border-gray-700 divide-y-2 divide-slate-200">
      @foreach ($order->orderitem as $item)
      <div class="items-center sm:flex">
        <div class="mb-3 mr-6 h-20 w-20 sm:mb-0">
          <img src="{{asset($item->product->thumbnail)}}" alt="product"
            class="h-full w-full rounded-sm object-cover object-center">
        </div>
        <div class="w-full items-center justify-between md:flex">
          <div class="mb-3 md:mb-0">
            <a href="#" class="inline-block font-medium text-black hover:text-primary dark:text-white">
              {{$item->product->title}}
            </a>
            <p class="flex text-sm font-medium">
              {{-- <span class="mr-5"> Color: White </span>
              <span class="mr-5"> Size: Medium </span> --}}
            </p>
          </div>
          <div class="flex items-center md:justify-end">
            <p class="mr-20 font-medium text-black dark:text-white">
              Qty: {{$item->qty}}
            </p>
            <p class="mr-5 font-medium text-black dark:text-white">
              {{formatCurrency($item->total)}}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="-mx-4 flex flex-wrap">
      <div class="w-full px-4 sm:w-1/2 xl:w-3/12">
        <div class="mb-10">
          <h4 class="mb-4 text-title-sm2 font-medium leading-[30px] text-black dark:text-white md:text-2xl">
            QrCode
          </h4>
          @php
          $removedXML = '
          <?xml version="1.0" encoding="UTF-8"?>';
          @endphp
          <div>
            {!! str_replace($removedXML,"", SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($order->code))!!}
          </div>
        </div>
      </div>
      <div class="w-full px-4 sm:w-1/2 xl:w-3/12">
        <div class="mb-10">
          <h4 class="mb-4 text-title-sm2 font-medium leading-[30px] text-black dark:text-white md:text-2xl">
            Payment Method
          </h4>
          <p class="font-medium capitalize">
            {{ $order->payment_method == 'cash_on_delivary' ? 'Cash On Delivery' : $order->payment_method }}
          </p>
        </div>
      </div>
      <div class="w-full px-4 xl:w-6/12">
        <div class="mr-10 text-right md:ml-auto">
          <div class="ml-auto sm:w-1/2">
            <p class="mb-4 flex justify-between font-medium text-black dark:text-white">
              <span> Subtotal </span>
              <span> {{ formatCurrency($order->total) }} </span>
            </p>
            <p class="mb-4 flex justify-between font-medium text-black dark:text-white">
              <span> Shipping Cost (+) </span>
              <span> {{ formatCurrency($order->shipping_cost) }} </span>
            </p>
            <p
              class="mb-4 mt-2 flex justify-between border-t border-gray-200 pt-6 font-medium text-black dark:border-gray-700  dark:text-white">
              <span> Total </span>
              <span> {{ formatCurrency($order->total+$order->shipping_cost) }} </span>
            </p>
          </div>

          <div class="mt-10 flex flex-col justify-end gap-4 sm:flex-row">
            <a href="/admin/orders/invoice/download/{{$order->id}}"
              class="flex items-center justify-center rounded border border-primary px-8 py-2.5 text-center font-medium text-primary hover:opacity-90">
              Download Invoice
            </a>
            {{-- <button
              class="flex items-center justify-center rounded bg-primary px-8 py-2.5 text-center font-medium text-gray hover:bg-opacity-90">
              Send Invoice
            </button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
  function printDiv()
 {

   var divToPrint=document.getElementById('printbleArea');

   var newWin=window.open('','Print-Window');

   newWin.document.open();

   newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

   newWin.document.close();

   setTimeout(function(){newWin.close();},10);

 }

 $(document).ready(function() {
  $('#printButton').on('click', function() {
    window.print();
  });
})

</script>
@endpush