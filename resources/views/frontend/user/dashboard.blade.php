@extends('layouts.frontend')
@section('title','Dasboard')
@section('content')
<!-- ---- BreadCrum ----- -->
<div class="container py-4 md:px-16 flex justify-between ">
    <div class="flex gap-3 items-center ">
        <a href="/" class="text-primary-light text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-500 ">
            <i class="fas fa-chevron-right"></i>
        </span>
        <p class="text-gray-500 font-medium uppercase">Dasboard</p>
    </div>

</div>
<!-- ---- End BreadCrum --->

<!-- ---- Account Wrapper--->

<div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16  md:flex-row text-primary-light">
    <!-- ---- Sidbar--->
    @include('frontend.partials.user_sidebar')
    <!-- ---- End Sidbar--->
   
    <div class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
       <!-- ----Account Content --->
       <div class="col-span-9 grid md:grid-cols-3 gap-4 mt-6 lg:mt-0 ">
        <div class="flex items-center bg-white border rounded overflow-hidden shadow">
            <div class="p-4 bg-teal-500">
           
                <svg class="h-12 w-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                  </svg>
                  
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Order</h3>
                <p class="text-3xl">{{auth()->user()->orders->count()}}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded overflow-hidden shadow">
            <div class="p-4 bg-red-500">
                <svg class="h-12 w-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                  
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Pending Orders</h3>
                <p class="text-3xl">{{auth()->user()->orders()->where('status', 'pending')->count()}}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded overflow-hidden shadow">
            <div class="p-4 bg-green-500">
                <svg class="h-12 w-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                  </svg>
                  
            </div>
            <div class="px-4 text-gray-700">
                <h3 class="text-sm tracking-wider">Completed Orders</h3>
                <p class="text-3xl">{{auth()->user()->orders()->where('status', 'completed')->count();}}</p>
            </div>
        </div>
        <!-- ----single card --->
        {{-- <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
            <div class="flex justify-between items-center mb-4 ">
                <h3 class="font-medium capitalize text-gray-800 text-lg">Personal Profile </h3>
                <a href="#" class="text-primary">Edit</a>
            </div>
            <div class="space-y-1">
                <h3 class="text-gray-700 font-medium">{{auth()->user()->name}}</h3>
                <p class="" text-gray-800>{{auth()->user()->email}}</p>
                <p class="" text-gray-800>{{auth()->user()->phone}}</p>
            </div>
        </div> --}}
        <!-- ----End single card --->


        <!-- ----single card --->
        {{-- <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
            <div class="flex justify-between items-center mb-4 ">
                <h3 class="font-medium capitalize text-gray-800 text-lg">Shipping Address </h3>
                <a href="#" class="text-primary">Edit</a>
            </div>
            <div class="space-y-1">
                <h3 class="text-gray-700 font-medium">{{auth()->user()->name}}</h3>
                <p class="" text-gray-800>{{auth()->user()->email}}</p>
                <p class="" text-gray-800>{{auth()->user()->phone}}</p>
            </div>
        </div> --}}
        <!-- ----End single card --->


        <!-- ----single card --->
        {{-- <div class="shadow rounded bg-gray-100 px-4 pt-6 pb-8">
            <div class="flex justify-between items-center mb-4 ">
                <h3 class="font-medium capitalize text-gray-800 text-lg">Builling Address </h3>
                <a href="#" class="text-primary">Edit</a>
            </div>
            <div class="space-y-1">
                <h3 class="text-gray-700 font-medium">{{auth()->user()->name}}</h3>
                <p class="" text-gray-800>{{auth()->user()->email}}</p>
                <p class="" text-gray-800>{{auth()->user()->phone}}</p>
            </div>
        </div> --}}
        <!-- ----End single card --->

        <h2 class="text-base col-span-3 my-1 md:text-lg font-medium text-gray-800 capitalize">
            Last 5 Orders
            <hr class="w-1/3 h-0.5 my-1 bg-gray-200 border-0 dark:bg-gray-700">
        </h2>

        <div class="col-span-3 relative overflow-x-auto rounded shadow-md border border-gray-200 bg-slate-300">
            <table class="w-full text-sm text-left rtl:text-right  text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delivary Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $item)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->code}}
                        </th>
                        <td class="px-6 py-4">
                            {{$item->created_at->format('d-m-Y')}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->total}}
                        </td>
                        <td class="px-6 py-4">
                            @switch($item->status)
                            @case('pending')
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>
                                @break
                            @case('completed')
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>
                                @break
                            @default
                                
                        @endswitch
                        </td>
                        <td class="px-6 py-4">
                            @switch($item->payment_status)
                                @case('pending')
                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>
                                    @break
                                @case('paid')
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Paid</span>
                                    @break
                                @default
                                    
                            @endswitch
                        </td>
                    </tr>
                    @empty

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" colspan="6" class="px-6 text-center text-red-600 py-4 font-medium  whitespace-nowrap">
                            No data found
                        </th>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    <!-- ----End Account Content--->
    </div>


    <!-- ----End Account Content--->


</div>

<!-- ---- End Account Wrapper --->
@endsection