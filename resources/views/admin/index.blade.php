@extends('layouts.app')
@push('title')
{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name') .' | Dashboard'}}
@endpush
@section('content')
<div class="container items-center h-screen px-4 py-8 m-auto">
  <div class="flex flex-wrap pb-3 bg-white dark:bg-slate-700 rounded divide-y shadow-lg lg:divide-x lg:divide-y-0">
    <div class="w-full p-2 lg:w-1/4 sm:w-1/2">
      <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between px-4 py-4">
          <div class="flex mr-4">
            <span class="items-center px-4 py-4 m-auto bg-blue-200 rounded-full hover:bg-blue-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="items-center w-8 h-8 m-auto text-blue-500 hover:text-blue-600"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                  d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
              </svg>
            </span>
          </div>
          <div class="flex-1 pl-1">
            <div class="text-xl font-medium text-gray-600">{{\App\Models\Order::select('id')->count()}}</div>
            <div class="text-sm text-gray-400 sm:text-base">
              Total Orders
            </div>
          </div>
        </div>
        <div class="px-4 pt-px">
          <div class="w-full h-2 bg-gray-200 rounded-md hover:bg-gray-300">
            <div class="h-2 bg-blue-500 rounded-md hover:bg-blue-600" style="width: 83%"></div>
          </div>
          <div class="flex flex-row items-center justify-between w-full py-px text-base text-gray-400">
            <p class="flex">change</p>
            <div class="flex items-center justify-between space-x-2">
              <p>83%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full p-2 lg:w-1/4 sm:w-1/2">
      <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between px-4 py-4">
          <div class="flex mr-4">
            <span class="items-center px-4 py-4 m-auto bg-red-200 rounded-full hover:bg-red-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="items-center w-8 h-8 m-auto text-red-500 hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </span>
          </div>
          <div class="flex-1 pl-1">
            <div class="text-xl font-medium text-gray-600">{{\App\Models\Order::where('status', 'pending')->select(['id', 'status'])->count()}}</div>
            <div class="text-sm text-gray-400 sm:text-base">
              Pending Orders
            </div>
          </div>
        </div>
        <div class="px-4 pt-px">
          <div class="w-full h-2 bg-gray-200 rounded-md hover:bg-gray-300">
            <div class="h-2 bg-red-500 rounded-md hover:bg-red-600" style="width: 78%"></div>
          </div>
          <div class="flex flex-row items-center justify-between w-full py-px text-base text-gray-400">
            <p class="flex">change</p>
            <div class="flex items-center justify-between space-x-2">
              <p>78%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full p-2 lg:w-1/4 sm:w-1/2">
      <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between px-4 py-4">
          <div class="flex mr-4">
            <span class="items-center px-4 py-4 m-auto bg-yellow-200 rounded-full hover:bg-yellow-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="items-center w-8 h-8 m-auto text-yellow-500 hover:text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
              </svg>
            </span>
          </div>
          <div class="flex-1 pl-1">
            <div class="text-xl font-medium text-gray-600">{{\App\Models\Order::where('status', 'completed')->select(['id', 'status'])->count()}}</div>
            <div class="text-sm text-gray-400 sm:text-base">
              Total Orders Completed
            </div>
          </div>
        </div>
        <div class="px-4 pt-px">
          <div class="w-full h-2 bg-gray-200 rounded-md hover:bg-gray-300">
            <div class="h-2 bg-yellow-500 rounded-md hover:bg-yellow-600" style="width: 86%"></div>
          </div>
          <div class="flex flex-row items-center justify-between w-full py-px text-base text-gray-400">
            <p class="flex">change</p>
            <div class="flex items-center justify-between space-x-2">
              <p>86%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full p-2 lg:w-1/4 sm:w-1/2">
      <div class="flex flex-col">
        <div class="flex flex-row items-center justify-between px-4 py-4">
          <div class="flex mr-4">
            <span class="items-center px-4 py-4 m-auto bg-green-200 rounded-full hover:bg-green-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="items-center w-8 h-8 m-auto text-green-500 hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
          </div>
          <div class="flex-1 pl-1">
            <div class="text-xl font-medium text-gray-600">{!!formatCurrency(\App\Models\Order::select(['id', 'total'])->sum('total'))!!}</div>
            <div class="text-sm text-gray-400 sm:text-base">
              Total Sales
            </div>
          </div>
        </div>
        <div class="px-4 pt-px">
          <div class="w-full h-2 bg-gray-200 rounded-md hover:bg-gray-300">
            <div class="h-2 bg-green-500 rounded-md hover:bg-green-600" style="width: 79%"></div>
          </div>
          <div class="flex flex-row items-center justify-between w-full py-px text-base text-gray-400">
            <p class="flex">change</p>
            <div class="flex items-center justify-between space-x-2">
              <p>79%</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
@endsection
