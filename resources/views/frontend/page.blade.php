@extends('layouts.frontend')
@section('title', $data->title)
@section('content')


<!-- ---- Start Category  ----- -->
<div class="mx-2 my-2 py-2 md:container lg:container">
     <div
          class="p-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
          <h2 class="text-base my-2 md:text-xl font-medium text-gray-800 uppercase">
               {{$data->title}}
               <hr class="w-2/3 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
          </h2>
          <p>{{$data->body}}</p>

     </div>

</div>
<!-- ---- End Category  ----- -->
@endsection