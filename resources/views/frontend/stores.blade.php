@extends('layouts.frontend')
@section('title', $title)
@section('content')


    <!-- ---- Start Category  ----- -->
    <div class="mx-4 my-2 py-2 md:container lg:container">



        <section class="lg:mx-8 rounded-lg bg-white dark:bg-gray-900 shadow-lg border border-gray-200">
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
                <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
                    <h2 class="mb-4 text-2xl lg:text-3xl tracking-tight font-bold text-gray-900 dark:text-white uppercase">
                        {{ $title }}</h2>
                    <p class="font-light text-gray-500 lg:text-xl dark:text-gray-400">Explore the whole collection of
                        open-source web components and elements built with the utility classes from Tailwind</p>
                </div>
                @foreach ($data as $state)
                    <h4 class="my-4 text-xl lg:text-3xl tracking-tight font-bold text-gray-900 dark:text-white uppercase">
                        {{ $state['title'] }}</h4>
                        @if ($state['items'])
                            
                        <div class="grid gap-8 lg:gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
                            @foreach ($state['items'] as $item)
                                <div
                                    class="px-2 py-4 text-left bg-white hover:bg-slate-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 group hover:shadow-xl">
                                    <h3 class="mb-1 text-lg lg:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        <a href="javascript:void(0)" class=" uppercase">{{ $item['title'] }}</a>
                                    </h3>
                                    <p>{{ $item['location'] }}</p>
                                    <p class="my-3 font-semibold text-sm text-gray-500">
                                        Phone: {{ $item['phone'] . (isset($item['phone_2']) ? ', ' . $item['phone_2'] : '') }}
                                    </p>
                                    @if (isset($item['tel']))
                                        
                                    <p class="my-3 font-semibold text-sm text-gray-500">Tel: {{ $item['tel'] }}</p>
                                    @endif
    
    
                                </div>
                            @endforeach
    
                        </div>
                        @endif
                @endforeach
            </div>
        </section>
    </div>
    <!-- ---- End Category  ----- -->
@endsection
