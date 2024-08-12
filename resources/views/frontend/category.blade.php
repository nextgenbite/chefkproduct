@extends('layouts.frontend')
@section('title', $data->title)
@section('content')
 
  
               <!-- ---- Start Category  ----- -->
               <div class="mx-2 md:container lg:container" >
                    <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
                         {{$data->title}} 
                         <hr class="w-1/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    </h2>
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3">
                         @forelse ($data->products as $product)

                                   @include('frontend.partials.product-x', ['product' => $product])
                         @empty
                              <div class="text-red-600 text-center text-bold">No Data Found</div>
                         @endforelse
                    </div>
               </div>
               <hr class=" my-8 bg-gray-200 border-0 dark:bg-gray-700">
               <!-- ---- End Category  ----- -->
@endsection