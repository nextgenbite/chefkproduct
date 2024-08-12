@extends('layouts.frontend')
@section('title', 'Order History')

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
        <p class="text-gray-500 font-medium uppercase">Order History</p>
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


            <h2 class="text-base col-span-3 my-1 md:text-lg font-medium text-gray-800 uppercase">
                Order History
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
                        @forelse ($data as $item)

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>
                                @break
                                @case('completed')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>
                                @break
                                @default

                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                @switch($item->payment_status)
                                @case('pending')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>
                                @break
                                @case('paid')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Paid</span>
                                @break
                                @default

                                @endswitch
                            </td>
                        </tr>
                        @empty

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" colspan="6"
                                class="px-6 text-center text-red-600 py-4 font-medium  whitespace-nowrap">
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