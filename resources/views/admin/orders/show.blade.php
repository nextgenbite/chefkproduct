@extends('admin.master')
@push('custom-css')
<style>
    @media print {
  body * {
    visibility: hidden;
  }
  #printArea,
  #printArea * {
    visibility: visible;
  }
  #printArea {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
@endpush
@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12">
      <div class="card" >
        <div class="card-body" id="printArea">
            <div class="container-fluid position-relative">
                <img style="left: 0;top:-20px;width: 6rem" class=" position-absolute" src="{{asset('logo-2.png')}}"  alt="" >
                <h3 class="text-right my-5">Invoice #8{{$order->id}}</h3>
                <hr>
            </div>
            {{-- <h1 class="text-center text-info mt-3">QBDbox.com</h1> --}}
          {{-- <div class="container-fluid d-flex justify-content-between">
              <div class=" pl-0">
                  <p class="mt-5 mb-2"><b>{{$order->name}}</b></p>
                  <p>{{$order->phone}}</p>
                  <p>{{$order->address}}</p>
                  <p>{{$order->note}}</p>
              </div>
              <div class=" pr-0">
                  <p class="mt-5 mb-2 text-right bold h4 {{$order->status == 0? 'text-danger' : $order->status == 1? 'text-info': 'text-success'}}"><b>{{$order->status == 0? 'Pending' : $order->status == 1? 'Confirm': 'Delivered'}}</b></p>

              </div>
            </div> --}}
            <div class="container-fluid d-flex justify-content-between">
                <div class=" pl-0">
                    <p class="mb-0  mt-2">Order Date : {{$order->order_date}}</p>

                </div>
                <div class=" pr-0">
                    <p class="mb-0 mt-2  text-left  ">Order Status : <b class="{{($order->status == 0) ? 'text-danger' : (($order->status == 1) ? 'text-info' : 'text-success')}}">{{$order->status == 0? 'Pending' : ($order->status == 1? 'Confirm': 'Delivered')}}</b></p>

              </div>
            </div>

          <div class="container-fluid d-flex justify-content-between">
            <div class=" pl-0">
                <p class="mt-2 mb-0 text-bold"><b>From</b></p>
                <p class=" text-bold">Quick BD Box (qbdbox.com)</p>
                <p class="">01777666178</p>
                <p>South Banasree,<br>Dhaka, Bangladesh.</p>
                <p class=" text-capitalize">7 Days replacement and 2 years service warranty</p>
                <small>Conditions apply*</small>
            </div>
            <div class=" pr-0">
                <p class="mt-2 mb-0 text-left"><b>Invoice to</b></p>
                <p   class="text-left">Customer : <b>{{$order->name}}</b></p>
                <p  class="text-left">Mobile No.:{{$order->phone}}</p>
                <p  class="text-left">Address :{{$order->address}}</p>
                <p  class="text-left">Thana :{{$order->thana}}</p>
                <p  class="text-left">District :{{$order->district}}</p>
                <p  class="text-left">Note:{{$order->notes}}</p>
            </div>
        </div>
          <div class="container-fluid mt-2 d-flex justify-content-center w-100">
              <div class="table-responsive table-bordered  w-100" >
                <table class="table">
                    <thead>
                        <tr class="">
                          <th>#</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th class="text-right">Quantity</th>
                          <th class="text-right">Unit cost</th>
                          <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->orderitem()->get() as $key=>$item)

                      <tr class="text-right">
                          <td class="text-left">{{$key+1}}</td>
                          <td class="text-left">
                            {{$item->product->product_name}} <br>
                            @if (isset($item->color))

                            Color: <small>{{$item->color}}</small><br>
                            @endif
                            @if (isset($item->size))

                            Size: <small>{{$item->size}}</small>
                            @endif
                        </td>
                          <td><img style="width: 4rem; height:4rem" src="{{asset($item->product->product_image)}} " class="img-rounded" width="100px" alt="sadd"> </td>
                          <td>{{$item->qty}}</td>
                          <td>{{$item->price}}</td>
                          <td>{{$item->price * $item->qty}}</td>
                      </tr>
                      @endforeach

                    </tbody>
                </table>
              <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
          </div>
          <div class="container-fluid mt-2 w-100">

              <p class="text-right">Delivery Cost : {{$order->delivery_type}} TK</p>
              <p class="text-right"> Discount : {{$order->coupon}} TK</p>
              <h4 class="text-right mb-5">Total : {{$order->delivery_type+$order->amount}} TK</h4>
              <hr>
          </div>
          <strong> Visit for more Proudcts: <b class="">www.qbdbox.com</b></strong>
      </div>
      <div class="card-body">

          <button class="btn btn-primary float-right" id="printButton" >Print</button>
      </div>
      </div>
    </div>
  </div>

</div>

@endsection
@push('custom-scripts')
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
